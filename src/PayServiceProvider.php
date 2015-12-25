<?php

// +----------------------------------------------------------------------
// | date: 2015-12-25
// +----------------------------------------------------------------------
// | PayServiceProvider: 支付服务
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\Pay;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class PayServiceProvider extends ServiceProvider
{

    /**
     * 定义延迟加载
     *
     * @var bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected $defer = false;

    /**
     * 执行注册后的启动服务。
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function boot()
    {
        //发布路由
        $this->setupRoutes($this->app->router);
        //发布配置文件
        $this->setConfig();
    }

    /**
     * 设置路由
     *
     * @return void
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Yangyifan\Pay\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }

    /**
     * 在容器中注册绑定
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function register()
    {
        $this->app->singleton('pay', function($app){
            return new \Yangyifan\Pay\Pay($app);
        });
    }

    /**
     * 设置配置信息
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function setConfig()
    {
        // 发布config配置文件
        $this->publishes([
            realpath(__DIR__.'/config/pay.php') => config_path('pay.php'),
        ]);

        $this->mergeConfigFrom(
            realpath(__DIR__.'/config/pay.php'), 'pay'
        );
    }

}