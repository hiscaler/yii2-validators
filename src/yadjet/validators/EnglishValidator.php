<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 判断是否为英文字母
 * 
 * @author hiscaler <hiscaler@gmail.com>
 */
class EnglishValidator extends Validator
{

    protected function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if (!preg_match("/^[a-zA-Z]+$/", $value)) {
            $message = $this->message !== null ? $this->message : "{$value} 包含无效的英文字符。";
            $this->addError($object, $attribute, $message);
        }
    }

}
