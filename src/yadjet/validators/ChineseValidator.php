<?php

use yii\validators\Validator;

/**
 * 判断是否为中文
 * 
 * @author hiscaler <hiscaler@gmail.com>
 */
class ChineseValidator extends Validator
{

    protected function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if (!preg_match("^[" . chr(0xa1) . "-" . chr(0xff) . "]+$", $value)) {
            $message = $this->message !== null ? $this->message : "{$value} 包含无效的中文字符。";
            $this->addError($object, $attribute, $message);
        }
    }

}
