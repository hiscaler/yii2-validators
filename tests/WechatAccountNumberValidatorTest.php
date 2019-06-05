<?php

namespace yadjet\helpers;

require __DIR__ . '/../vendor/autoload.php';
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

use PHPUnit\Framework\TestCase;
use yadjet\validators\WechatAccountNumberValidator;

/**
 * Class WechatAccountNumberValidatorTest
 *
 * @package yadjet\helpers
 * @author hiscaler <hiscaler@gmail.com>
 */
class WechatAccountNumberValidatorTest extends TestCase
{

    public function testValid()
    {
        $validator = new WechatAccountNumberValidator();
        $this->assertEquals($validator->validate('15874186666'), true);
        $this->assertEquals($validator->validate('abcde'), false);
        $this->assertEquals($validator->validate('abcdef'), true);
        $this->assertEquals($validator->validate('his'), false);
        $this->assertEquals($validator->validate('@abc'), false);
    }

}
