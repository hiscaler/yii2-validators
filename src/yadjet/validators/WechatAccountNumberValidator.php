<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 判断是否为有效的微信号
 *
 * 可以使用6—20个字母、数字、下划线和减号，必须以字母开头（不区分大小写），不支持设置中文 【实际有所调整，比如纯手机号码】
 *
 * @see http://kf.qq.com/faq/120322fu63YV130422BNJjEv.html
 * @author hiscaler <hiscaler@gmail.com>
 */
class WechatAccountNumberValidator extends Validator
{

    private function isValid($value)
    {
        return preg_match("/^[a-zA-Z0-9][a-zA-Z0-9_-]{5,19}$/", $value);
    }

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        if ($this->isEmpty($value) && $this->skipOnEmpty) {
            return;
        }

        if (!$this->isValid($value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的手机号码。";
            $this->addError($model, $attribute, $message);
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
