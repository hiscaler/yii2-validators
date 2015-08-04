<?php

namespace yadjet\validators;

use Yii;
use yii\validators\Validator;

/**
 * 手机号码验证
 */
class MobilePhoneNumberValidator extends Validator
{

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        if ($this->isEmpty($value) && $this->skipOnEmpty) {
            return;
        }

        if (!preg_match("/^((\(\d{3}\))|(\d{3}\-))?13|15\d{9}$/", $value)) {
            $message = $this->message !== null ? $this->message : Yii::t('validator', '{attribute} not mobile phone.');
            $this->addError($model, $attribute, $message);
        }
    }

}
