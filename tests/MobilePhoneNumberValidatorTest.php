<?php

namespace yadjet\helpers;

require __DIR__ . '/../vendor/autoload.php';
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

use PHPUnit\Framework\TestCase;
use yadjet\validators\MobilePhoneNumberValidator;

/**
 * Class MobilePhoneNumberValidatorTest
 *
 * @package yadjet\helpers
 * @author hiscaler <hiscaler@gmail.com>
 */
class MobilePhoneNumberValidatorTest extends TestCase
{

    public function testValid()
    {
        $validator = new MobilePhoneNumberValidator();
        $this->assertEquals($validator->validate('15874186666'), true);
        $this->assertEquals($validator->validate('1587418666'), false);
        $this->assertEquals($validator->validate('158741866666'), false);
        $this->assertEquals($validator->validate('11587418666'), false);
    }

}
