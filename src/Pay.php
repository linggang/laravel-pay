<?php

// +----------------------------------------------------------------------
// | date: 2015-12-25
// +----------------------------------------------------------------------
// | Pay.php: 支付
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\Pay;

use Yangyifan\Pay\Library\AliPay;
use Yangyifan\Pay\Library\EximbayPay;
use InvalidArgumentException;

class Pay
{
    /**
     * 支付方式
     *
     * @var array
     */
    protected $pay_method = [];

    /**
     * app 实例
     *
     * @var object
     */
    protected $app;

    /**
     * 构造方法
     *
     * @param $app app实例
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * 支付方式
     *
     * @param null $name
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function drive($name = null)
    {
        return $this->pay($name);
    }

    /**
     * 获得支付对象
     *
     * @param null $name
     * @return object
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function pay($name = null)
    {
        //支付方式
        $name = $name ?: $this->getDefaultName();

        return $this->pay_method[$name] = $this->get($name);
    }

    /**
     * 获得当前支付对象
     *
     * @return object
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function get($name = null)
    {
        return isset($this->pay_method[$name]) ? $this->pay_method[$name] : $this->resolve($name);
    }

    /**
     * 设置支付对象
     *
     * @param $name
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function resolve($name)
    {
        $driver = "create" . ucfirst(strtolower($name)) . "Driver";

        if ( method_exists($this, $driver)) {
            return $this->$driver();
        } else {
            throw new InvalidArgumentException(" [{$driver}] 支付方式不存在.");
        }
    }

    /**
     * 实现支付适配器
     *
     * @param PayInterface $pay
     * @return PayAdapter
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function adapt(PayInterface $pay)
    {
        return new PayAdapter($pay);
    }

    /**
     * 创建支付宝支付
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function createAlipayDriver()
    {
        return $this->adapt(
            new AliPay()
        );
    }

    /**
     * 创建Eximbay支付
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function createEximbayDriver()
    {
        return $this->adapt(
            new EximbayPay()
        );
    }

    /**
     * 获得默认支付方式
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function getDefaultName()
    {
        return $this->app['config']['pay.default'];
    }

    /**
     * __call 魔术方法
     *
     * @param $name
     * @param $arguments
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->pay(), $name], $arguments);
    }
}