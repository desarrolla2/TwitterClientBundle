<?php

/*
 * This file is part of the desarrolla2 package.
 * 
 * Short description   
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 * @date Aug 9, 2012, 12:24:04 AM
 * @file TwitterClient.php , UTF-8
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Desarrolla2\Bundle\TwitterClientBundle\Service;

use Desarrolla2\Bundle\RSSClientBundle\Model\RSSClientInterface;
use Desarrolla2\Bundle\TwitterClientBundle\Model\Twit;
use Desarrolla2\Bundle\TwitterClientBundle\Util\TwitterUtil;

class TwitterClient
{

    /**
     * @var Desarrolla2\Bundle\RSSClientBundle\Model\RSSClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $screenName;

    /**
     * @var string
     */
    protected $searchQuery;

    /**
     * @var string
     */
    protected $urlScreenName = 'http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=';

    /**
     * @var string
     */
    protected $urlSearch = 'http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=';

    /**
     * @var array 
     */
    protected $twits = array();

    /**
     * @var string
     */

    const TWIT_LENGHT = 160;

    /**
     *
     * @param Twit $twit
     */
    protected function addTwit(Twit $twit)
    {
        array_push($this->twits, $twit);
    }

    /**
     *
     * @return type 
     */
    public function getScreenNameUrl()
    {
        return $this->urlScreenName . $this->screenName;
    }

    /**
     *
     * @param RSSClientInterface $client 
     */
    public function setClient(RSSClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     *
     * @param string $screenName 
     */
    public function setScreenName($screenName)
    {
        $this->screenName = (string) $screenName;
    }

    /**
     *
     * @param string $searchQuery 
     */
    public function setSearchQuery($searchQuery)
    {
        $this->searchQuery = (string) $searchQuery;
    }

    /**
     * 
     */
    public function count()
    {
        
    }

    /**
     * Retrieves a $limit number of twits
     * 
     * @param int $limit
     * @return array $twits
     */
    protected function getTwits($limit = 20)
    {
        $limit = (int) $limit;
        $response = array();
        for ($i = 0; $i < $limit; $i++) {
            if (isset($this->twits[$i])) {
                array_push($response, $this->twits[$i]);
            }
        }
        return $response;
    }

    /**
     * 
     */
    public function fetch($limit = 20)
    {
        $limit = (int) $limit;
        $this->client->setFeed($this->getScreenNameUrl());
        $nodes = $this->client->fetch($limit);

        foreach ($nodes as $node) {
            $twit = new Twit();
            $twit->setText($this->parseText($node->getTitle()));
            $twit->setLink($node->getLink());
            $twit->setPubDate($node->getPubDate());
            $this->addTwit($twit);
        }

        return $this->getTwits($limit);
    }

    /**
     * 
     * @return Twit | false
     */
    public function fetchOne()
    {
        $twits = $this->fetch(1);
        if (count($twits)) {
            return $twits[0];
        }
        return false;
    }

    /**
     * Parse Twit Text: links, users, and hashtag
     * @param type $text
     * @return type 
     */
    protected function parseText($text)
    {
        $text = trim(substr($text, (strlen($this->screenName) + 2), self::TWIT_LENGHT));
        return TwitterUtil::parse($text);
    }

}
