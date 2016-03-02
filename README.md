### 使用

* 在 ``` composer.json ``` 加入 ``` "yangyifan/laravel-pay" : "dev-master" ```
* 执行 ``` php composer update -vvv yangyifan/laravel-pay ``` 注意 ```php``` 必须定位到您本机安装的php目录下面的bin目录下面的php路径
* 更新完毕执行 ``` php artisan vendor:publish ``` 
* 在 ``` config/app.php ``` 加入 ``` 'Yangyifan\Pay\PayServiceProvider' ```
* 在 ``` config\pay ``` 文件自定义自己的参数

### 支持

* 支付宝国际
* Eximbay

### Laravel 要求
* ``` >= 5.0 ``` 

### 使用支付

* 发起 支付宝 支付

```
use Yangyifan\Pay\Pay;
use Yangyifan\Pay\Library\AliPay;
use Yangyifan\Pay\Http\Requests\AliPayRequest;

/**
 * 发起支付宝支付
 *
 * @param Request $request
 */
public function alipay(AliPayRequest $request)
{
    $data = $request->all();
    //发起支付
    ( new Pay('AliPay') )->createPay($data['order_sn'], $data['price'], $data);
    或者
    Pay::setPayMethod('alipay')->createPay($data['order_sn'], $data['price'], $data);
}
    
```

* 发起 Eximbay 支付

```
use Yangyifan\Pay\Pay;
use Yangyifan\Pay\Library\EximbayPay;
use Yangyifan\Pay\Http\Requests\EximbayPayRequest;

/**
 * 发起eximbay支付
 *
 * @author yangyifan <yangyifanphp@gmail.com>
 */
public function EximbayPay(EximbayPayRequest $request)
{
    $data = $request->all();
    //发起支付
    ( new Pay('EximbayPay') )->createPay($data['order_sn'], $data['price'], $data);
    或者
    Pay::setPayMethod('alipay')->createPay($data['order_sn'], $data['price'], $data);
}

```

### 使用验证

* 支付宝 验证

```
#验证异步支付是否合法
( new Pay('AliPay') )->verifyReturn();


#验证异步支付是否合法
( new Pay('AliPay') )->verifyNotify()

```

* Exmibay 验证

```
#验证异步支付是否合法
( new Pay('EximbayPay') )->verifyReturn()

#验证异步支付是否合法
( new Pay('EximbayPay') )->verifyNotify()

```

### 配置信息

```

//支付宝合作信息
    'alipay' => [
        'partner'       => '',//合作身份者id，以2088开头的16位纯数字
        'key'           => '',
        'sign_type'     => '',//签名方式
        'input_charset' => 'utf-8',//字符编码格式 目前支持 gbk 或 utf-8
        'transport'     => 'http',//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        'cacert'        => '',//ca证书路径地址，用于curl中ssl校验
    ],

    //支付宝通知url
    'alipay_url' => [
        'notify_url' => '',//服务器异步通知页面路径
        'return_url' => '',//页面跳转同步通知页面路径
    ],

    // eximbay 支付信息
    'eximbay' => [
        'secretKey'     => '',
        'mid'           => '',
        'cur'           => '',//货币
        'product_name'  => '',//项目名称
        'lang'          => '',//语言
        'charset'       => '',//字符集
        'ver'           => '',//版本
        'shop'          => '',
    ],

    //Exmibay通知url
    'eximbay_url' => [
        'returnurl' => "",//服务器异步通知页面路径
        'statusurl' => '',//页面跳转同步通知页面路径
    ],

```


### 注意

* 发起请求的时候，需要查看 AliPayRequest or EximbayPayRequest 依赖哪些参数。


#### Lincense 

MIT
