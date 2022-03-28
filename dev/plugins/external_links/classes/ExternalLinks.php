<?php
/**
 * External Links
 *
 * This file is part of Grav External Links plugin.
 *
 * Dual licensed under the MIT or GPL Version 3 licenses, see LICENSE.
 * http://benjamin-regler.de/license/
 */

namespace Grav\Plugin;

use Grav\Common\Utils;
use Grav\Common\Grav;

/**
 * External Links
 *
 * Helper class to add small icons to external and mailto links, informing
 * users the link will take them to a new site or open their email client.
 */
class ExternalLinks
{
    /**
     * @var ExternalLinks
     */

    /** -------------
     * Public methods
     * --------------
     */

    /**
     * Process contents i.e. apply filer to the content.
     *
     * @param  string     $content The content to render.
     * @param  array      $options Options to be passed to the renderer.
     * @param  null|Page  $page    Null or an instance of \Grav\Common\Page.
     *
     * @return string              The rendered contents.
     */
    public function render($content, $options = [], $page = null)
    {
        // Get all <a> tags and process them
        $content = preg_replace_callback('~<a(?:\s[^>]*)?>.*?</a>~i',
            function($match) use ($options, $page) {
                // Load PHP built-in DOMDocument class
                if (($dom = $this->loadDOMDocument($match[0])) === null) {
                    return $match[0];
                }

                // Check that there is really a link tag
                $a = $dom->getElementsByTagName('a');
                if ($a->length == 0) {
                    return $match[0];
                }
                $a = $a->item(0);

                // Process links with non-empty href attribute
                $href = $a->getAttribute('href');
                if (strlen($href) == 0) {
                    return $match[0];
                }

                // Get the class of the <a> element
                $class = $a->hasAttribute('class') ? $a->getAttribute('class') : '';
                $classes = array_filter(explode(' ', $class));

                // Exclude links with specific class from processing
                $exclude = $options->get('exclude.classes', null);
                if ($exclude && !!array_intersect($exclude, $classes)) {
                    return $match[0];
                }

                // Get domains to be seen as internal
                $domains = $options->get('exclude.domains', []);

                // This is a mailto link.
                if (strpos($href, 'mailto:') === 0) {
                    $classes[] = 'mailto';
                }

                // The link is external
                elseif ($url = $this->isExternalUrl($href, $domains, $page)) {
                    // Add external class
                    $classes[] = 'external-link';
                    $a->setAttribute('href', $url);

                    // Add target="_blank"
                    $target = $options->get('target');
                    if ($target) {
                        $a->setAttribute('target', $target);
                    }

                    // Add no-follow.
                    $nofollow = $options->get('no_follow');
                    if ($nofollow) {
                        $rel = array_filter(explode(' ', $a->getAttribute('rel')));
                        if (!in_array('nofollow', $rel)) {
                            $rel[] = 'nofollow';
                            $a->setAttribute('rel', implode(' ', $rel));
                        }
                    }

                    // Set rel="noopener noreferrer"
                    $rel = $a->hasAttribute('rel') ? $a->getAttribute('rel') : '';
                    $rel = array_filter(explode(' ', $rel));

                    $rel[] = 'noopener';
                    $rel[] = 'noreferrer';
                    $a->setAttribute('rel', implode(' ', array_unique($rel)));

                    // Add image class to <a> if it has at least one <img> child element
                    $imgs = $a->getElementsByTagName('img');
                    if ($imgs->length > 1) {
                        // Add "images" class to <a> element, if it has multiple child images
                        $classes[] = 'images';
                    } elseif ($imgs->length == 1) {
                        $imgNode = $imgs->item(0);

                        // Get image size
                        list($width, $height) = $this->getImageSize($imgNode);

                        // Determine maximum dimension of image size
                        $size = max($width, $height);

                        // Depending on size determine image type
                        $classes[] = ((0 < $size) && ($size <= 32)) ? 'icon' : 'image';
                    } else {
                        // Add "no-image" class to <a> element, if it has no child images
                        $classes[] = 'no-image';
                    }

                    // Add title (aka alert text)
                    if ($options->get('title')) {
                        $language = Grav::instance()['language'];
                        $message = $language->translate(['PLUGINS.EXTERNAL_LINKS.TITLE_MESSAGE']);

                        // Set default title to link else, set title as data attribute
                        $key = $a->hasAttribute('title') ? 'data-title' : 'title';
                        $a->setAttribute($key, $message);
                    }
                }

                // Set class attribute
                if (count($classes) && ($options->get('mode') === 'active')) {
                    $a->setAttribute('class', implode(' ', $classes));
                }

                // Save Dom document back to HTML representation
                $html = $this->saveDOMDocument($dom);
                return $html;
            }, $content);

        // Write content back to page
        return $content;
    }

    /** -------------------------------
     * Private/protected helper methods
     * --------------------------------
     */

    /**
     * Test if a URL is external
     *
     * @param  string     $url      The URL to test.
     * @param  array      $domains  An array of domains to be seen as internal.
     * @param  null|Page  $page     Null or an instance of \Grav\Common\Page.
     *
     * @return mixed                Returns the URL as a string, if it is external,
     *                              false otherwise.
     */
    protected function isExternalUrl($url, $domains = [], $page = null)
    {
        static $allowed_protocols;
        static $pattern;

        /** @var Config $config */
        $config = Grav::instance()['config'];

        /** @var Page $page */
        $page = $page ?: Grav::instance()['page'];

        // Statically store allowed protocols
        if (!isset($allowed_protocols)) {
            $allowed_protocols = array_flip(
                $config->get('plugins.external_links.links.schemes', ['http', 'https'])
            );
        }

        // Statically store internal domains as a PCRE pattern.
        if (!isset($pattern) || (count($domains) > 0)) {
            $domains = array_merge($domains,
                array(Grav::instance()['base_url_absolute']));

            foreach ($domains as $domain) {
                $domains[] = preg_quote($domain, '#');
            }
            $pattern = '#(' . str_replace(array('\*', '/*'), '.*?',
                implode('|', $domains)) . ')#i';
        }

        $external = false;
        // Check for URLs that don't match any excluded domain
        if (!preg_match($pattern, $url)) {
            // Check if URL is external by extracting colon position
            $colonpos = strpos($url, ':');
            if ($colonpos > 0) {
                // We found a colon, possibly a protocol. Verify.
                $protocol = strtolower(substr($url, 0, $colonpos));
                if (isset($allowed_protocols[$protocol])) {
                    // The protocol turns out be an allowed protocol
                    $external = $url;
                }
            }  else {
                if ($config->get('plugins.external_links.links.www')) {
                    // Remove possible path duplicate
                    $route = Grav::instance()['base_url'] . $page->route();
                    $href = Utils::startsWith($url, $route)
                        ? ltrim(mb_substr($url, mb_strlen($route)), '/')
                        : $url;

                    // We found an url without protocol, but with starting 'www' (sub-)domain
                    if (Utils::startsWith($url, 'www.')) {
                        $external = 'http://' . $url;
                    } elseif (Utils::startsWith($href, 'www.')) {
                        $external = 'http://' . $href;
                    }
                }
                if ($config->get('plugins.external_links.links.redirects')) {
                    $targetPage = Grav::instance()['pages']->find($url);
                    if ($targetPage && $targetPage->redirect()) {
                        $external = $this->isExternalUrl($targetPage->redirect(), $domains, $page);
                    }
                }
            }
        }

        // Only if a valid protocol or an URL starting with 'www.' was found return true
        return $external;
    }

    /**
     * Determine the size of an image
     *
     * @param  DOMNode $imgNode The image already parsed as a DOMNode
     * @param  integer $limit   Load first $limit KB of remote image
     *
     * @return array            Return the dimension of the image of the
     *                          format array(width, height)
     */
    protected function getImageSize($imgNode, $limit = 32)
    {
        // Hold units (assume standard font with 16px base pixel size)
        // Calculations based on pixels
        $units = array(
            'px' => 1,            /* base unit: pixel */
            'pt' => 16 / 12,      /* 12 point = 16 pixel = 1/72 inch */
            'pc' => 16,           /* 1 pica = 16 pixel = 12 points */

            'in' => 96,           /* 1 inch = 96 pixel = 2.54 centimeters */
            'mm' => 96 / 25.4,    /* 1 millimeter = 96 pixel / 1 inch [mm] */
            'cm' => 96 / 2.54,    /* 1 centimeter = 96 pixel / 1 inch [cm] */
            'm' => 96 / 0.0254,   /* 1 centimeter = 96 pixel / 1 inch [m] */

            'ex' => 7,            /* 1 ex = 7 pixel */
            'em' => 16,           /* 1 em = 16 pixel */
            'rem' => 16,          /* 1 rem = 16 pixel */

            '%' => 16 / 100,      /* 100 percent = 16 pixel */
        );

        // Initialize dimensions
        $width = 0;
        $height = 0;

        // Determine image dimensions based on "src" atrribute
        if ($imgNode->hasAttribute('src')) {
            $src = $imgNode->getAttribute('src');

            // Simple check if the URL is internal i.e. check if path exists
            $path = $_SERVER['DOCUMENT_ROOT'] . $src;
            if (realpath($path) && is_file($path)) {
                $size = @getimagesize($path);
            } else {
                // The URL is external; try to load it (default: 32 KB)
                $size = $this->getRemoteImageSize($src, $limit * 1024);
            }
        }

        // Read out width and height from <img> attributes
        $width = $imgNode->hasAttribute('width') ?
            $imgNode->getAttribute('width')  : $size[0];
        $height = $imgNode->hasAttribute('height') ?
            $imgNode->getAttribute('height')  : $size[1];

        // Get width and height from style attribute
        if ( $imgNode->hasAttribute('style') ) {
            $style = $imgNode->getAttribute('style');

            // Width
            if (preg_match('~width:\s*(\d+)([a-z]+)~i', $style, $matches)) {
                $width = $matches[1];
                // Convert unit to pixel
                if ( isset($units[$matches[2]]) ) {
                    $width *= $units[$matches[2]];
                }
            }

            // Height
            if (preg_match('~height:\s*(\d+)([a-z]+)~i', $style, $matches)) {
                $height = $matches[1];
                // Convert unit to pixel
                if (isset($units[$matches[2]])) {
                    $height *= $units[$matches[2]];
                }
            }
        }

        // Update width and height
        $size[0] = $width;
        $size[1] = $height;

        // Return image dimensions
        return $size;
    }

    /**
     * Get the size of a remote image
     *
     * @param  string  $uri   The URI of the remote image
     * @param  integer $limit Load first $limit bytes of remote image
     *
     * @return mixed          Returns an array with up to 7 elements
     */
    protected function getRemoteImageSize($uri, $limit = -1)
    {
        // Create temporary file to store data from $uri
        $tmp_name = tempnam(sys_get_temp_dir(), uniqid('ris'));
        if ($tmp_name === false) {
            return false;
        }

        // Open temporary file
        $tmp = fopen($tmp_name, 'wb');

        // Check which method we should use to get remote image sizes
        $allow_url_fopen = ini_get('allow_url_fopen') ? true : false;
        $use_curl = function_exists('curl_version');

        // Use stream copy
        if ($allow_url_fopen) {
            $options = [];
            if ( $limit > 0 ) {
                // Loading number of $limit bytes
                $options['http']['header'] = array('Range: bytes=0-' . $limit);
            }

            // Create stream context
            $context = stream_context_create($options);
            @copy($uri, $tmp_name, $context);

        // Use Curl
        } elseif ($use_curl) {
            // Initialize Curl
            $options = array(
                CURLOPT_HEADER => false,            // Don't return headers
                CURLOPT_FOLLOWLOCATION => true,     // Follow redirects
                CURLOPT_AUTOREFERER => true,        // Set referrer on redirect
                CURLOPT_CONNECTTIMEOUT => 120,      // Timeout on connect
                CURLOPT_TIMEOUT => 120,             // Timeout on response
                CURLOPT_MAXREDIRS => 10,            // Stop after 10 redirects
                CURLOPT_ENCODING => '',             // Handle all encodings
                CURLOPT_BINARYTRANSFER => true,     // Transfer as binary file
                CURLOPT_FILE => $tmp,               // Curl file
                CURLOPT_URL => $uri,                // URI
            );

            $curl = curl_init();
            curl_setopt_array($curl, $options);

            if ($limit > 0) {
                // Loading number of $limit
                $headers = array('Range: bytes=0-' . $limit);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_RANGE, '0-' . $limit);

                // Abort request when more data is received
                curl_setopt($curl, CURLOPT_BUFFERSIZE, 512);    // More progress info
                curl_setopt($curl, CURLOPT_NOPROGRESS, false);  // Monitor progress
                curl_setopt($curl, CURLOPT_PROGRESSFUNCTION,
                    function($download_size, $downloaded, $upload_size, $uploaded) use ($limit) {
                        // If $downloaded exceeds $limit, returning non-zero breaks
                        // the connection!
                        return ( $downloaded > $limit ) ? 1 : 0;
                });
            }

            // Execute Curl
            curl_exec($curl);
            curl_close($curl);
        }

        // Close temporary file
        fclose($tmp);

        // Retrieve image information
        $info = array(0, 0, 'width="0" height="0"');
        if (filesize($tmp_name) > 0) {
            $info = @getimagesize($tmp_name);
        }

        // Delete temporary file
        unlink($tmp_name);

        return $info;
    }

    /**
     * Load contents into PHP built-in DOMDocument object
     *
     * Two Really good resources to handle DOMDocument with HTML(5)
     * correctly.
     *
     * @see http://stackoverflow.com/questions/3577641/how-do-you-parse-and-process-html-xml-in-php
     * @see http://stackoverflow.com/questions/7997936/how-do-you-format-dom-structures-in-php
     *
     * @param  string      $content The content to be loaded into the
     *                              DOMDocument object
     *
     * @return DOMDocument          DOMDocument object of content
     */
    protected function loadDOMDocument($content)
    {
        // Clear previous errors
        if (libxml_use_internal_errors(true) === true) {
            libxml_clear_errors();
        }

        // Parse content using PHP built-in DOMDocument class
        $document = new \DOMDocument('1.0', 'UTF-8');

        // Encode contents as UTF-8, strip whitespaces & normalize newlines
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');

        // $whitespaces = array(
        //   '~\R~u' => "\n",         // Normalize new line
        //   '~\>[^\S ]+~s' => '>',   // Strip whitespaces after tags, except space
        //   '~[^\S ]+\<~s' => '<',   // Strip whitespaces before tags, except space
        //   '~(\s)+~s' => '\\1'      // Shorten multiple whitespace sequences
        // );
        // $content = preg_replace(array_keys($whitespaces), $whitespaces, $content);

        // Parse the HTML using UTF-8
        // The @ before the method call suppresses any warnings that
        // loadHTML might throw because of invalid HTML in the page.
        @$document->loadHTML($content);

        // Do nothing, if DOM is empty
        if (is_null($document->documentElement)) {
            return null;
        }

        return $document;
    }

    /**
     * Save contents of PHP built-in DOMDocument object as HTML5
     *
     * @param  DOMDocument $document DOMDocument object with nodes
     *
     * @return string                The outputted DOM document as HTML(5)
     *                               compliant string
     */
    protected function saveDOMDocument($document)
    {
        // Pretty print output
        $document->preserveWhiteSpace = false;
        $document->formatOutput       = true;

        // Transform DOM document to valid HTML(5)
        $content = '';
        $body = $document->getElementsByTagName('body')->item(0);
        foreach ($body->childNodes as $node) {
            // Expand empty tags (e.g. <br/> to <br></br>)
            if (($html = $document->saveXML($node, LIBXML_NOEMPTYTAG)) !== false) {
                $content .= $html;
            }
        }

        // Fix formatting for self-closing tags in HTML5 and removing
        // encapsulated (uncommented) CDATA blocks in <script> and
        // <style> tags
        $regex = array(
            '~' . preg_quote('<![CDATA[', '~') . '~' => '',
            '~' . preg_quote(']]>', '~') . '~' => '',
            '~></(?:area|base(?:font)?|br|col|command|embed|frame|hr|img|input|keygen|link|meta|param|source|track|wbr)>~' => ' />',
        );

        // Make XML HTML5 compliant
        $content = preg_replace(array_keys($regex), $regex, $content);
        return $content;
    }
}
