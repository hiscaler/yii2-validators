<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 电话号码验证
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
class PhoneNumberValidator extends Validator
{

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        if ($this->isEmpty($value) && $this->skipOnEmpty) {
            return;
        }

        if (!preg_match("/^((\(\d{3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}$/", $value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的电话号码。";
            $this->addError($model, $attribute, $message);
        }
    }

}
