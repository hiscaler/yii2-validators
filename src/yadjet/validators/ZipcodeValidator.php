<?php

namespace yadjet\validators;

use Yii;
use yii\validators\Validator;

/**
 * 邮政编码验证
 */
class ZipcodeValidator extends Validator {

    public function validateAttribute($model, $attribute) {
        $value = $model->$attribute;
        if ($this->isEmpty($value) && $this->skipOnEmpty) {
            return;
        }

        if (!preg_match("/^[1-9]\d{5}$/", $value)) {
            $message = $this->message !== null ? $this->message : Yii::t('validator', '{attribute} not zipcode.');
            $this->addError($model, $attribute, $message);
        }
    }

}
