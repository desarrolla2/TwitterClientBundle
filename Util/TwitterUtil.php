<?php

/**
 * This file is part of the TwitterClientBundle proyect.
 * 
 * Description of Util
 *
 * @author : Daniel González Cerviño <daniel.gonzalez@freelancemadrid.es>
 * @file : TwitterUtil.php , UTF-8
 * @date : Aug 20, 2012 , 11:10:20 AM
 */

namespace Desarrolla2\Bundle\TwitterClientBundle\Util;

abstract class TwitterUtil
{

    /**
     * Parse Twit Text: links, users, and hashtag
     * @param type $text
     * @return type 
     */
    static public function parseText($text)
    {
        $text = (string) $text;
        // links
        $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1">$1</a>', $text);
        // users         
        $text = preg_replace('(@([a-zA-Z0-9_]+))', '<a href="http://www.twitter.com/\1">\0</a>', $text);
        // hastag
        $text = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1<a href="http://search.twitter.com/search?q=%23\2">#\2</a>', $text);

        return $text;
    }

}