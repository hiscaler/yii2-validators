<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 判断是否为合法的 IP 地址
 *
 * @package yadjet\validators
 * @author hiscaler <hiscaler@gmail.com>
 */
class IpValidator extends Validator
{

    public $allowEmpty = false;

    private function isValid($value)
    {
        return preg_match("/((25[0-5])|(2[0-4]d)|(1dd)|([1-9]d)|d)(.((25[0-5])|(2[0-4]d)|(1dd)|([1-9]d)|d)){3}/", $value);
    }

    public function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if ($this->allowEmpty && $this->isEmpty($value)) {
            return;
        }

        if (!$this->isValid($value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的 IP 地址。";
            $this->addError($object, $attribute, $message);
        }
    }

    public function validateValue($value)
    {
        if (!$this->isValid($value)) {
            return [$this->message, []];
        }

        return null;
    }

}
