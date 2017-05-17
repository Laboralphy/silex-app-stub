<?php

use \Services\AnimLibDataService;

/**
 * Created by PhpStorm.
 * User: ralphy
 * Date: 17/05/17
 * Time: 16:42
 */
class AnimLibDataServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testShowList() {
        $al = new AnimLibDataService();
        $this->assertEquals(array('Paranoia Agent'), $al->getShowList());
    }
}
