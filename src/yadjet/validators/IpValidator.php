<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 判断是否为合法的 IP 地址
 * 
 * @author hiscaler <hiscaler@gmail.com>
 */
class IpValidator extends Validator
{

    public $allowEmpty = false;

    public function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if ($this->allowEmpty && $this->isEmpty($value)) {
            return;
        }

        if (!preg_match("/((25[0-5])|(2[0-4]d)|(1dd)|([1-9]d)|d)(.((25[0-5])|(2[0-4]d)|(1dd)|([1-9]d)|d)){3}/", $value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的 IP 地址。";
            $this->addError($object, $attribute, $message);
        }
    }

}
