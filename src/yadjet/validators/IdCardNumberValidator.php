<?php

namespace yadjet\validators;

use yii\validators\Validator;

/**
 * 大陆身份证验证规则
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
class IdCardNumberValidator extends Validator
{

    public $toggleField = '';

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        if (!$this->validateValue($value)) {
            $message = $this->message !== null ? $this->message : "{$value} 不是一个有效的身份证号码。";
            $this->addError($model, $attribute, $message);
        } else {
            if (!empty($this->toggleField)) {
                $attr = $this->toggleField;
                $birthday = $model->$attr;
                if (!$this->checkBirthday($value, $birthday)) {
                    $message = $this->message !== null ? $this->message : "{$value} 与指定出生年月不相符。";
                    $this->addError($model, $attribute, $message);
                }
            }
        }
    }

    public function validateValue($value)
    {
        if (strlen($value) == 18) {
            return $this->idCardNumberCheckIs18($value);
        } elseif ((strlen($value) == 15)) {
            $value = $this->idCardNumber15218($value);

            return $this->idCardNumberCheckIs18($value);
        } else {
            return false;
        }
    }

    public function checkBirthday($idCardNumber, $birthday)
    {
        if (!empty($birthday)) {
            $length = strlen($idCardNumber);
            if ($length == 15) {
                $idCardNumber = $this->idCardNumber15218($idCardNumber);
            }
            $birthday = preg_replace('[\D]', '', $birthday);

            return (substr($idCardNumber, 6, 8) == $birthday) ? true : false;
        } else {
            return true;
        }
    }

    // 计算身份证校验码，根据国家标准GB 11643-1999
    public function idCardNumberVerfiy($idCardNumberBase)
    {
        if (strlen($idCardNumberBase) != 17) {
            return false;
        }
        //加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        //校验码对应值
        $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        $checksum = 0;
        for ($i = 0; $i < strlen($idCardNumberBase); $i++) {
            $checksum += substr($idCardNumberBase, $i, 1) * $factor[$i];
        }
        $mod = $checksum % 11;
        $verify_number = $verify_number_list[$mod];

        return $verify_number;
    }

    // 将15位身份证升级到18位
    public function idCardNumber15218($idCardNumber)
    {
        if (strlen($idCardNumber) != 15) {
            return false;
        } else {
            // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
            if (array_search(substr($idCardNumber, 12, 3), array('996', '997', '998', '999')) !== false) {
                $idCardNumber = substr($idCardNumber, 0, 6) . '18' . substr($idCardNumber, 6, 9);
            } else {
                $idCardNumber = substr($idCardNumber, 0, 6) . '19' . substr($idCardNumber, 6, 9);
            }
        }
        $idCardNumber = $idCardNumber . $this->idCardNumberVerfiy($idCardNumber);

        return $idCardNumber;
    }

    // 18位身份证校验码有效性检查
    public function idCardNumberCheckIs18($idcard)
    {
        if (strlen($idcard) != 18) {
            return false;
        }
        $idcard_base = substr($idcard, 0, 17);
        if ($this->idCardNumberVerfiy($idcard_base) != strtoupper(substr($idcard, 17, 1))) {
            return false;
        } else {
            return true;
        }
    }

}
