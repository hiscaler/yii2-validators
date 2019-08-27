<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 手机号码验证
 *
 * @package yadjet\validators
 * @author hiscaler <hiscaler@gmail.com>
 */
class MobilePhoneNumberValidator extends Validator
{

    private function isValid($value)
    {
        return preg_match("/^1[3456789]\d{9}$/", $value);
    }

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        if ($this->isEmpty($value) && $this->skipOnEmpty) {
            return;
        }

        if (!$this->isValid($value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的手机号码。";
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
