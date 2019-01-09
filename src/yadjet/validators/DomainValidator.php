<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 判断是否为有效的域名
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
class DomainValidator extends Validator
{

    public $allowEmpty = true;

    private function isValid($value)
    {
        return preg_match("/[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+\.?/", $value) ? true : false;
    }

    public function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if ($this->allowEmpty && $this->isEmpty($value)) {
            return;
        }

        if (!$this->isValid($value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的域名。";
            $this->addError($object, $attribute, $message);
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
