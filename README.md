# Bytedance 字节跳动接口

## 说明

大部分代码是引用了`cvoid/bytedance-mini-app`这位兄弟的包，有些接口不支持（例如分账），所以用了这位兄弟的包 做扩展，如有侵权，立马下架。

## 安装(Installation)

```shell
composer require zgclives/bytedance
```

## 功能(Features)

| api                          | 实现                    | 是否完成 |
| ---------------------------- | ----------------------- | -------- |
| getAccessToken               | login->getAccessToken() | ☑️       |
| 登录 - code2Session          | login->code2Session()   | ☑️       |
| 数据缓存 - setUserStorage    |                         |          |
| 数据缓存 - removeUserStorage |                         |          |
| 创建二维码 - createQRCode    | tool->createQRCode      | ☑️       |
| 内容安全检测                 |                         |          |
| 图片检测 V2                  |                         |          |
| 订阅消息推送                 | tool->sendSubscribedMessage | ☑️        |
| 服务端预下单                 | payment->createOrder    | ☑️       |
| 服务端支付回调               | payment->notify         | ☑️       |
| 订单查询                     | payment->queryOrder     | ☑️       |
| 退款                         | payment->createRefund   | ☑️       |
| 退款回调                     | payment->refundNotify   | ☑️       |
| 查询退款                     | payment->queryRefund    | ☑️       |
| 分账                         | payment->createSettle  | ☑️       |
| 分账回调                     | payment->querySettle    | ☑️       |
| 查询分账                     | payment->querySettle    | ☑️       |
| 服务商进件                   |                         |          |
| 分账方进件                   |                         |          |

## 使用(Usage)

### getApp

```php
require_once __DIR__.'./vendor/autoload.php';

use \Bytedance\BytedanceApp;

$app = new \Bytedance\BytedanceApp('appId', 'secret', 'salt', 'token');
```

### 获取AccessToken

```php
$response = $app->login->accessToken();

$access_token = $response->accessToken;
$expires_in = $response->expiresIn;
```

### 登录

```php
$response = $app->login->code2Session($code);

return [
    'session_key' => $response->sessionKey,
    'openid'      => $response->openId,
    'unionid'     => $response->unionId,
];
```

### 创建二维码

```php
$access_token = $app->login->accessToken()->accessToken;
return $app->tool->createQRCode($access_token, $app->tool::APP_DOUYIN, 'pages/index/index');
```

### 订阅消息推送

```php
$access_token = $app->login->accessToken()->accessToken;
return $app->tool->sendSubscribedMessage($access_token, $tpl_id, $open_id, $data, 'pages/index/index');
```

### 服务端预下单

```php
$response = $app->payment->createOrder($out_order_no, $total_amount, $subject, $body, $valid_time, $cp_extra, $notify_url);

return [
    'order_id'    => $response->orderId,
    'order_token' => $response->orderToken
];
```

### 订单查询

```php
$response = $app->payment->queryOrder($out_order_no);

return $response;
//[totalFee] => 2
//[orderStatus] => SUCCESS
//[payTime] => 2021-08-26 17:38:49
//[way] => 1
//[channelNo] => 4321001296202108269673188430
//[channelGatewayNo] => 12108260167652952855
```

### 退款

```php
$response = $app->payment->createOrder($out_order_no, $total_amount, $subject, $body, $valid_time, $cp_extra, $notify_url);

return [
    'order_id'    => $response->orderId,
    'order_token' => $response->orderToken
];
```

### 分账

```php
$response = $app->payment->createSettle($out_settle_no, $out_order_no, $settle_desc, $settle_params, $cp_extra, $notify_url);

return [
    'settle_no'     => $response->settleNo
];
```

### 分账查询

```php
$response = $app->payment->querySettle($out_order_no);

return [
    'settle_no'     => $response->settleNo,
    'settle_status' => $response->settleStatus,
    'settle_amount' => $response->settleAmount,
    'settle_detail' => $response->settleDetail,
    'settled_at'    => $response->settleAt,
    'rake'          => $response->rake,
    'commission'    => $response->commission,
    'cp_extra'      => $response->cpExtra,
];
```
