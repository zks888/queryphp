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

namespace App\App\Controller\Restful;

use Leevel\Http\IRequest;
use Leevel\Router\IRouter;

/**
 * show.
 *
 * @author Xiangmin Liu <635750556@qq.com>
 *
 * @since 2018.07.20
 *
 * @version 1.0
 */
class Show
{
    public function handle(IRequest $request)
    {
        return 'hello for restful '.IRouter::RESTFUL_SHOW.
            ' and id is '.$request->params->get('_param0');
    }
}
