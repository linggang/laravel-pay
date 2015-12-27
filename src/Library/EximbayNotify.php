<?php

// +----------------------------------------------------------------------
// | date: 2015-12-25
// +----------------------------------------------------------------------
// | EximbayNotify.php: EximbayPay 支付
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\Pay\Library;

use Illuminate\Http\Request;

class EximbayNotify
{
    const RES_CODE_SUCCESS = '0000';//

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct()
    {

    }

    /**
     * 验证同步支付
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function verifyReturn(Request $request)
    {
        $order_sn   = $request->get('ref');
        $rescode    = $request->get('rescode');
        $rescode    = $request->get('rescode');
//
//        if (!empty($order_sn) &&  $rescode == self::RES_CODE_SUCCESS) {
//            return true;
//        }
        \Log::error('EximbayNotify error:' . $rescode . ',' . json_encode($request->all()));
       return true;
    }

    /**
     * 验证异步支付
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function verifyNotify()
    {
        return true;
    }
}