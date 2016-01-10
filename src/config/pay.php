<?php

return [

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

];