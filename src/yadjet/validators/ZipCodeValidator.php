<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 邮政编码验证
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
class ZipCodeValidator extends Validator
{

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        if ($this->isEmpty($value) && $this->skipOnEmpty) {
            return;
        }

        if (!preg_match("/^[1-9]\d{5}$/", $value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的邮政编码。";
            $this->addError($model, $attribute, $message);
        }
    }

}
