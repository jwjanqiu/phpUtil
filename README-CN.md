# PHP常用方法

[![Latest Stable Version](https://poser.pugx.org/aliyuncs/oss-sdk-php/v/stable)](https://packagist.org/packages/aliyuncs/oss-sdk-php)


## 概述

可能用的上方法，陆陆续续补充...


## 运行环境
- PHP 7.2+

## 安装方法

1. 如果您通过composer管理您的项目依赖，可以在你的项目根目录运行：

        $ composer require qiuyier/phpUtil

   或者在你的`composer.json`中声明对phpUtil的依赖：

        "require": {
            "qiuyier/phpUtil": "1.0"
        }

   然后通过`composer install`安装依赖。composer安装完成后，在您的PHP代码中引入依赖即可：

        require_once __DIR__ . '/vendor/autoload.php';


## 快速使用

### 常用类

| 类名 | 解释 |
|:------------------|:------------------------------------|
|pageData | 列表分页数据格式封装 |
|subtext | 截取多余字符以省略号返回|
|priceCalculate | 价格计算|
|priceFormat | 价格格式化|
|priceYuan2fen | 价格由元转分|
|generateRandomCode | 随机验证码|
|computingTimeDifference | 计算两个时间的差|
|getAgeByID | 通过身份证算年龄|
|getMsecTime | 获取毫秒级时间戳|
|desensitize | 信息脱敏|

