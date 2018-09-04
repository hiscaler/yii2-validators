<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 判断是否为有效的 QQ 号码
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
class QqValidator extends Validator
{

    public $allowEmpty = true;

    public function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if ($this->allowEmpty && $this->isEmpty($value)) {
            return;
        }

        if (!preg_match("/^[1-9]\d{4,12}$/", $value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的 QQ 号码。";
            $this->addError($object, $attribute, $message);
        }
    }

}
