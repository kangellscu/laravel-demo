<?php

namespace spec\App\Utils;

use PhpSpec\ObjectBehavior;
use App\Utils\MoneyUnitConvertUtil;
use \PHPUnit_Framework_Assert as Assert;

class MoneyUnitConvertUtilSpec extends ObjectBehavior
{
    
    /**************** yuanToFen ************/
    public function it_should_generate_integer_fen_from_yuan()
    {
        Assert::assertEquals(10036, MoneyUnitConvertUtil::yuanToFen('100.36'));
        Assert::assertTrue(is_int(MoneyUnitConvertUtil::yuanToFen(100.36)));
        Assert::assertEquals(57, MoneyUnitConvertUtil::yuanToFen(0.57));
    }

    public function it_should_generate_integer_yuan_from_fen()
    {
        Assert::assertEquals('18.36', MoneyUnitConvertUtil::fenToYuan(1836));
        Assert::assertTrue(is_string(MoneyUnitConvertUtil::fenToYuan(1836)));
    }
}
