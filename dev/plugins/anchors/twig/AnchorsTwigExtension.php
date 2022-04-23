<?php

namespace Grav\Plugin;

class AnchorsTwigExtension extends \Twig_Extension
{

    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getName()
    {
        return 'AnchorsTwigExtension';
    }
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('anchors', [$this, 'anchorsFunction'])
        ];
    }


    /**
     * Get a list of anchors link
     *
     * @param $content
     * @param $tag
     * @return string
     */
    public function anchorsFunction($content, $tag = 'h2', $terms = null)
    {

        $configTags = array_map('trim', explode(',',$this->config));

        if (in_array($tag, $configTags)){
            $textMenu = [];
            $rx = '/<'.$tag.'>(.*)<\/'.$tag.'>/';

            preg_match_all($rx, $content, $group);

            if (!empty($group[1])){

                if (!empty($terms)){
                    $termsArray = array_map('trim', explode(',',$terms));
                    $elements = array_diff($group[1],$termsArray);
                }else{
                    $elements = $group[1];
                }

                foreach($elements as $element){
                    $textMenu[] = $element;
                }
                $html = $this->getHtmlTag($textMenu);
            }else{
                $html = '';
            }
        }else{
            $tag = current($configTags);
            $html = $this->anchorsFunction($tag, $content);
        }

        return $html;

    }


    /**
     * Mount the html of anchors link
     *
     * @param $itens
     * @return string
     */
    private function getHtmlTag($itens)
    {
        $html = '';

        $html .= '<ul class="items-menus-page">';
        foreach($itens as $item){
            $html .= '<li><a href="#'.$this->getUrl($item).'">'.$this->textLimit($item, 50, false).'</a></li>';
        }
        $html .= '</ul>';

        return $html;
    }


    /**
     * Get url whithout special characters
     *
     * @param $text
     * @return string
     */
    private function getUrl($text)
    {
        $rx1 = array('ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','Â','Ã','É','Ê','Ô','Í','Ó','Õ','Ú','ñ','Ñ','ç','Ç');
        $rx2 = '/\'/';
        $rx3 = '/[& \+\$,:;=\?@"#\{\}\|\^~\[`%!\'<>\]\.\/\(\)\*ºª]/';
        $rx4 = '/-{2,}/';
        $rx5 = '/\^-+|-+$/';


        $urlAnchor1 = str_replace('–', '-', str_replace($rx1, '', $text));
        $urlAnchor2 = preg_replace($rx2, '', $urlAnchor1);
        $urlAnchor3 = preg_replace($rx3, '-', $urlAnchor2);
        $urlAnchor4 = $this->textLimit(preg_replace($rx4, '-', $urlAnchor3), 64);
        $urlAnchor5 = preg_replace($rx5, '', $urlAnchor4);

        $urlAnchorFinal = strtolower($urlAnchor5);

        return $urlAnchorFinal;
    }


    /**
     * It limit characters total in exit
     *
     * @param $text
     * @param $limit
     * @param bool|true $url //verify if type content is url or title
     * @return string
     */
    private function textLimit($text, $limit, $url = true)
    {
        $count = strlen($text);
        if ( $count >= $limit ) {
            if ($url){
                $text = substr($text, 0, $limit);
                return $text;
            }else {
                $text = substr($text, 0, strrpos(substr($text, 0, $limit), ' ')) . '...';
                return $text;
            }
        }
        else{
            return $text;
        }
    }
}
