<?php

// +----------------------------------------------------------------------
// | date: 2015-12-25
// +----------------------------------------------------------------------
// | Pay.php: 支付
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\Pay;


class Pay{

    private $pay;//支付方式

    /**
     * 构造方法
     *
     * @param $pay
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(PayInterface $pay)
    {
        $this->pay = $pay;
    }

    /**
     * 发起支付
     *
     * @param $order_sn 订单编号
     * @param $price 支付金额
     * @param $params 全部参数
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function createPay($order_sn, $price, $params)
    {
        $this->pay->createPay($order_sn, $price, $params);
    }

    /**
     * 验证同步支付是否合法
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function verifyReturn()
    {
        return $this->pay->verifyReturn();
    }

    /**
     * 验证异步支付是否合法
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function verifyNotify()
    {
        return $this->pay->verifyNotify();
    }
}