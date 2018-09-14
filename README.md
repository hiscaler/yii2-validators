# 关于
基于 Yii2 的验证器

## 安装方法
```php
composer require "yadjet/yii2-validators:dev-master"
```

## 使用方法
```php
public function rules()
{
    return [
        ......
        ['username', '\yadjet\validators\ChineseValidator'],
        ['username', '\yadjet\validators\EnglishValidator'],
        ['id_card_number', '\yadjet\validators\IdCardNumberValidator'],
        ['ip', '\yadjet\validators\IpValidator'],
        ['mobile_phone', '\yadjet\validators\MobilePhoneNumberValidator'],
        ['tel', '\yadjet\validators\PhoneNumberValidator'],
        ['qq', '\yadjet\validators\QqValidator'],
        ['zip_code', '\yadjet\validators\ZipcodeValidator'],
    ];
}
```