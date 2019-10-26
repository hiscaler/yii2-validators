<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 邮政编码验证
 *
 * @package yadjet\validators
 * @author hiscaler <hiscaler@gmail.com>
 */
class ZipCodeValidator extends Validator
{

    private function isValid($value)
    {
        return preg_match("/^[1-9]\d{5}$/", $value);
    }

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        if ($this->isEmpty($value) && $this->skipOnEmpty) {
            return;
        }

        if (!$this->isValid($value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的邮政编码。";
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
