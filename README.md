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
    ( new Pay( new AliPay()) )->createPay($data['order_sn'], $data['price'], $data);
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
    ( new Pay( new EximbayPay()) )->createPay($data['order_sn'], $data['price'], $data);
}

```

### 使用验证

* 支付宝 验证

```
#验证异步支付是否合法
( new Pay(new AliPay()) )->verifyReturn()

#验证异步支付是否合法
( new Pay(new AliPay()) )->verifyNotify()

```

* Exmibay 验证

```
#验证异步支付是否合法
( new Pay(new EximbayPay()) )->verifyReturn()

#验证异步支付是否合法
( new Pay(new EximbayPay()) )->verifyNotify()

```


### 注意

* 发起请求的时候，需要查看 AliPayRequest or EximbayPayRequest 依赖哪些参数。


#### Lincense 

MIT
