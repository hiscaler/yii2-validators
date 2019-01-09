<?php

namespace yadjet\helpers;

require __DIR__ . '/../vendor/autoload.php';
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

use PHPUnit\Framework\TestCase;
use yadjet\validators\DomainValidator;

/**
 * Class DomainValidatorTest
 *
 * @package yadjet\helpers
 * @author hiscaler <hiscaler@gmail.com>
 */
class DomainValidatorTest extends TestCase
{

    public function testValid()
    {
        $validator = new DomainValidator();
        $this->assertEquals($validator->validate('www.example.com'), true);
        $this->assertEquals($validator->validate('example.com'), true);
        $this->assertEquals($validator->validate('www.abc.example.com'), true);
        $this->assertEquals($validator->validate('a@com'), false);
        $this->assertEquals($validator->validate('.com'), false);
        $this->assertEquals($validator->validate('abc'), false);
        $this->assertEquals($validator->validate('11.22.33'), true);
    }

}
