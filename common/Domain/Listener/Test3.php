<?php declare(strict_types=1);
// (c) 2018 http://your.domain.com All rights reserved.
namespace Common\Domain\Listener;

/**
 * test3 监听器
 *
 * @author Name Your <your@mail.com>
 * @package $$
 * @since 2018.01.29
 * @version 1.0
 */
class Test3 extends Listener
{

    /**
     * 构造函数
     * 支持依赖注入
     * 
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * 监听器响应
     * 
     * @return void
     */
    public function run()
    {
        echo 'test3';
    }
}