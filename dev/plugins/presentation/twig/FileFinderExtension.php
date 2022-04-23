<?php
namespace Grav\Plugin\PresentationPlugin;

/**
 * Search for a file in multiple locations
 */
class FileFinderTwigExtension extends \Twig_Extension
{
    /**
     * Declare extension name
     *
     * @return string
     */
    public function getName()
    {
        return 'FileFinderExtension';
    }

    /**
     * Declare functions
     *
     * @return void
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('filefinder', [$this, 'fileFinder'])
        ];
    }

    /**
     * Call static function
     *
     * @param string $file         Filename.
     * @param string $ext          File extension.
     * @param array  ...$locations List of paths.
     * 
     * @return string
     */
    public function fileFinder($file, $ext, ...$locations)
    {
        return PresentationPlugin::fileFinder($file, $ext, ...$locations);
    }
}