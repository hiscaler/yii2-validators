<?php

namespace yadjet\validators;

use Yii;
use yii\validators\Validator;

class PhoneNumberValidator extends Validator
{

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        if ($this->isEmpty($value) && $this->skipOnEmpty) {
            return;
        }

        if (!preg_match("/^((\(\d{3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}$/", $value)) {
            $message = $this->message !== null ? $this->message : Yii::t('validator', '{attribute} not phone.');
            $this->addError($model, $attribute, $message);
        }
    }

}
