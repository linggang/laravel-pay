<?php

// +----------------------------------------------------------------------
// | date: 2015-12-25
// +----------------------------------------------------------------------
// | PayController.php: 支付控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\Pay\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\BaseController;
//use Yangyifan\Pay\Pay;
use Yangyifan\Pay\Library\AliPay;
use Yangyifan\Pay\Library\EximbayPay;
use Yangyifan\Pay\Http\Requests\AliPayRequest;
use Yangyifan\Pay\Http\Requests\EximbayPayRequest;
use pay;

class PayController extends BaseController
{

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 发起支付
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex(AliPayRequest $request)
    {
        $data = $request->all();
        //发起支付
        //( new Pay('AliPay') )->createPay($data['order_sn'], $data['price'], $data);
        Pay::setPayMethod('alipay')->createPay($data['order_sn'], $data['price'], $data);
    }

    /**
     * 发起支付
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex1(EximbayPayRequest $request)
    {
        $data = $request->all();
        //发起支付
        //( new Pay('EximbayPay') )->createPay($data['order_sn'], $data['price'], $data);
    }
}
