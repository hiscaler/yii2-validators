<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 电话号码验证
 *
 * @package yadjet\validators
 * @author hiscaler <hiscaler@gmail.com>
 */
class PhoneNumberValidator extends Validator
{

    private function isValid($value)
    {
        return preg_match("/^((\(\d{3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}$/", $value);
    }

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        if ($this->isEmpty($value) && $this->skipOnEmpty) {
            return;
        }

        if (!$this->isValid($value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的电话号码。";
            $this->addError($model, $attribute, $message);
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
