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

class Pay{

    /**
     * 支付方式
     *
     * @var object
     */
    private $pay = null;

    /**
     * 支付方式
     *
     * @var string
     */
    private $pay_method;

    /**
     * 构造方法
     *
     * @param $pay_method 支付方式
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct($pay_method = '')
    {
        //设置支付方式
        !empty($pay_method) && $this->pay_method = $pay_method;

        return $this;
    }

    /**
     * 获得当前支付方式
     *
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getPayMethod()
    {
        return $this->pay_method;
    }

    /**
     * 设置支付方式
     *
     * @param $pay_method
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function setPayMethod($pay_method)
    {
        $this->pay_method = $pay_method;
        return $this;
    }

    /**
     * 实例化支付对象
     *
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function setPay()
    {
        //创建实例
        $pay_method = "create" . ucfirst(strtolower($this->pay_method));

        if ( method_exists($this, $pay_method)) {
            $this->pay = $this->{$pay_method}();
        } else {
            throw new InvalidArgumentException(" [{$pay_method}] 支付方式不存在.");
        }

        return $this;
    }

    /**
     * 获得支付对象
     *
     * @return $this|object
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function getPay()
    {
        if ( !is_null($this->pay) && $this->pay instanceof PayInterface ) {
            return $this->pay;
        }
        //设置支付对象
        $this->setPay();
        //返回支付对象
        return $this->pay;
    }

    /**
     * 创建支付宝支付
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function createAlipay()
    {
        return new AliPay();
    }

    /**
     * 创建Eximbay支付
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function createEximbayPay()
    {
        return new EximbayPay();
    }

    /**
     * 发起支付
     *
     * @param $order_sn 订单编号
     * @param $price    支付金额
     * @param $params   全部参数
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function createPay($order_sn, $price, $params)
    {
        $this->getPay()->createPay($order_sn, $price, $params);
    }

    /**
     * 验证同步支付是否合法
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function verifyReturn()
    {
        return $this->getPay()->verifyReturn();
    }

    /**
     * 验证异步支付是否合法
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function verifyNotify()
    {
        return $this->getPay()->verifyNotify();
    }
}