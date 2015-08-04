# 关于
基于 Yii2 的验证器

# 安装方法
```php
composer require "yadjet/yii2-validators:dev-master"
```

# 使用方法
```php
public function rules()
{
    return [
        ......
        [['mobile_phone'], '\yadjet\validators\MobilePhoneNumberValidator'],
    ];
}
```