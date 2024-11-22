# 巨益OMS SDK

[巨益OMS开放平台接口签名](https://www.yuque.com/greatonce/oms3/sign_rule)

[巨益OMS开放平台接口文档](http://open.greatonce.com:30002)

## 安装

```shell
$ composer require yihaitao/greatonce -vvv
```

## 使用

```php
<?php

use YiHaiTao\GreatOnce\GreatOnce;

$config = [
    'app_key' => 'your-key',
    'app_secret' => 'your-secret',
    'customer_id' => 'your-customer-id',
    'base_url' => ' https://your-domain/api/api.do',
];

// 实例化巨益OMS SDK
$greatonce = new GreatOnce($config);
// 使用如下
$greatonce->request('method', $params);

// 例子
$result = $greatonce->request('deliveryorder.create', $params);
print_r($result);
```

## License

MIT
