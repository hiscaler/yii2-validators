<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 判断是否为英文字母
 *
 * @package yadjet\validators
 * @author hiscaler <hiscaler@gmail.com>
 */
class EnglishValidator extends Validator
{

    private function isValid($value)
    {
        return preg_match("/^[a-zA-Z]+$/", $value);
    }

    public function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if (!$this->isValid($value)) {
            $message = $this->message !== null ? $this->message : "{$value} 包含无效的英文字符。";
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
