<?php declare(strict_types=1);
// (c) 2018 http://your.domain.com All rights reserved.

use Leevel\Bootstrap\Project;
use Leevel\Kernel\{
    IKernel,
    IKernelConsole,
    Runtime\IRuntime
};
use Common\App\{
    Kernel,
    KernelConsole,
    Exception\Runtime
};

/**
 * ---------------------------------------------------------------
 * Composer
 * ---------------------------------------------------------------
 *
 * 用于管理 PHP 依赖包
 * 优化 composer 性能，优先载入 composer 注册的 Psr4
 * 如果 Psr4 不存在，才会去初始化 composer 加载，使得大部分请求不走 composer 的自动载入
 * 如果你使用的包是比较新的，基本都遵循 Psr4 规则，这个时候会提升 30~40 ms 上下性能
 */
$psr4s = include_once __DIR__ . '/../vendor/composer/autoload_psr4.php';

require_once  __DIR__ . '/../vendor/hunzhiwange/framework/src/Queryyetsimple/Bootstrap/function.php';

spl_autoload_register(function ($className) use($psr4s) {
    static $loadedComposer;

    $name = explode('\\', $className);

    // 顶层命名空间
    $topLevel = $name[0] . '\\';

    if (isset($psr4s[$topLevel])) {
        foreach ($psr4s[$topLevel] as $dir) {
            $file =  $dir . '/' . str_replace('\\', '/', substr($className, strlen($topLevel))) . '.php';

            if (is_file($file)) {
                require_once $file;
                break;
            }
        }

        return;
    }

    // 第二层 todo
    
    // 第三层 todo

    if (! $loadedComposer) {
       require_once __DIR__ . '/../vendor/autoload.php';
       $loadedComposer = true;
    }
});

/**
 * ---------------------------------------------------------------
 * 创建项目
 * ---------------------------------------------------------------
 *
 * 注册项目基础服务
 */
$project = Project::singletons(realpath(__DIR__ . '/..'));

$project->singleton(IKernel::class, Kernel::class);

$project->singleton(IKernelConsole::class, KernelConsole::class);

$project->singleton(IRuntime::class, Runtime::class);

return $project;
