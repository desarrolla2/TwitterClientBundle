<?php

/**
 * This file is part of the TwitterClientBundle proyect.
 * 
 * Description of TwitterUtilTest
 *
 * @author : Daniel González Cerviño <daniel.gonzalez@ideup.com>
 * @file : TwitterUtilTest.php , UTF-8
 * @date : Aug 20, 2012 , 11:15:15 AM
 */

namespace Desarrolla2\Bundle\TwitterClientBundle\Test\Util;

use Desarrolla2\Bundle\TwitterClientBundle\Util\TwitterUtil;

class TwitterUtilTest extends \PHPUnit_Framework_TestCase
{

    public function parseTextDataProvider()
    {
        return array(
            array('@desarrolla2', '<a href="http://www.twitter.com/desarrolla2">@desarrolla2</a>'),
            array('http://desarrolla2.com', '<a href="http://desarrolla2.com">http://desarrolla2.com</a>'),
            array('#desarrolla2', '<a href="http://search.twitter.com/search?q=%23desarrolla2">#desarrolla2</a>'),
        );
    }

    /**
     * @test
     * @dataProvider parseTextDataProvider
     */
    public function testParseText($test_case, $result)
    {
        $this->assertEquals(TwitterUtil::parseText($test_case), $result);
    }

}