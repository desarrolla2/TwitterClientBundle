<?php

/*
 * This file is part of the desarrolla2 package.
 * 
 * Short description   
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 * @date Aug 9, 2012, 12:10:29 AM
 * @file TwitterClient.php , UTF-8
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Desarrolla2\Bundle\TwitterClientBundle\Model;

class Twit
{

    /**
     * @var string
     */
    protected $text = null;

    /**
     * @var string
     */
    protected $link = null;

    /**
     *
     * @var \DateTime
     */
    protected $pubDate = null;

    /**
     * 
     * @param string $string
     * @return string $string 
     */
    protected function doClean($string)
    {
        return $string;
    }

    /**
     *
     * @param string $text 
     */
    public function setText($text)
    {
        $this->text = $this->doClean($text);
    }

    /**
     *
     * @return string $text 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     *
     * @param string $link 
     */
    public function setLink($link)
    {
        $this->link = $this->doClean($link);
    }

    /**
     *
     * @return string $link  
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     *
     * @param  string $date 
     */
    public function setPubDate(\DateTime $date)
    {
        $this->pubDate = $date;
    }

    /**
     *
     * @return DateTime $date 
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    public function getTimestamp()
    {
        if ($this->pubDate) {
            return $this->pubDate->getTimestamp();
        }
        return 0;
    }

}
