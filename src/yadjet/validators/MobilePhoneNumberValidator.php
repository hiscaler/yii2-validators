<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 手机号码验证
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
class MobilePhoneNumberValidator extends Validator
{

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        if ($this->isEmpty($value) && $this->skipOnEmpty) {
            return;
        }

        if (!preg_match("/^((\(\d{3}\))|(\d{3}\-))?13|14|15|16|17|18|19\d{9}$/", $value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的手机号码。";
            $this->addError($model, $attribute, $message);
        }
    }

}
