<?php

// +----------------------------------------------------------------------
// | date: 2015-12-25
// +----------------------------------------------------------------------
// | AliPay.php: 支付宝支付
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\Pay\Library;

use Yangyifan\Pay\PayInterface;

class AliPay implements PayInterface
{
    private $config;
    private $notify_url;//服务器异步通知页面路径
    private $return_url;//页面跳转同步通知页面路径
    private $service    = 'create_forex_trade';
    private $currency   = 'USD';//货币类型

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct()
    {
        $this->config = $this->mergeAlipayConfig();
    }

    /**
     * 组合支付宝配置信息
     *
     * @param $config
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function mergeAlipayConfig()
    {
        $config = config('pay.alipay');

        if (!empty($config) && empty($config['cacert'])) {
            $config['cacert'] = dirname(dirname(__DIR__)) . '/alipay/cacert.pem';
        }
        return $config;
    }

    /**
     * 创建并发起支付宝支付
     *
     * @param $order_sn 订单编号
     * @param $total_price 订单支付总金额
     * @param $params 全部参数
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function createPay($order_sn, $price, $params)
    {
        //发起支付
        $this->initiatePayment($this->mergePayParams($order_sn, $price, $params['subject'], $params['body']));
    }

    /**
     * 组合支付参数
     *
     * @param $body
     * @param $total_price
     * @param $order_sn
     * @param $subject
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function mergePayParams($order_sn, $price, $subject, $body)
    {
        //组合参数
        $param = [
            '_input_charset'    => $this->config['input_charset'],
            'currency'          => $this->currency,
            'partner'           => $this->config['partner'],
            'service'           => $this->service,
            'sign_type'         => $this->config['sign_type'],
            'body'              => empty($body) ? "" : $body,
            'out_trade_no'      => $order_sn,
            'rmb_fee'           => $price,
            'subject'           => $subject,

        ];

        $this->notify_url   = config('pay.alipay_url.notify_url');
        $this->return_url   = config('pay.alipay_url.return_url');

        if(!empty($this->notify_url)){
            $param['notify_url'] = $this->notify_url;
        }
        if(!empty($this->return_url)) {
            $param['return_url'] = $this->return_url;
        }
        return $param;
    }

    /**
     * 发起支付
     *
     * @param $param
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function initiatePayment($param)
    {
        echo ( new AlipaySubmit($this->config) )->buildRequestForm($param, "get", "确认");
    }

}