<?php

declare(strict_types=1);

/*
 * This file is part of the your app package.
 *
 * The PHP Application For Code Poem For You.
 * (c) 2018-2099 http://yourdomian.com All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests;

/**
 * 助手方法.
 *
 * @author Xiangmin Liu <635750556@qq.com>
 *
 * @since 2018.08.26
 *
 * @version 1.0
 */
trait Helper
{
    /**
     * 创建日志目录.
     *
     * @var array
     */
    protected function makeLogsDir(): array
    {
        $tmp = explode('\\', static::class);
        array_shift($tmp);
        $className = array_pop($tmp);
        $traceDir = dirname(__DIR__).'/runtime/tests/'.implode('/', $tmp);

        if (!is_dir($traceDir)) {
            mkdir($traceDir, 0777, true);
        }

        return [$traceDir, $className];
    }
}
