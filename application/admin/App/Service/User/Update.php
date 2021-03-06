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

namespace Admin\App\Service\User;

use Common\Domain\Service\User\UserRoleUpdate;

/**
 * 用户更新.
 *
 * @author Name Your <your@mail.com>
 *
 * @since 2017.10.23
 *
 * @version 1.0
 */
class Update
{
    /**
     * 用户更新服务.
     *
     * @var \Common\Domain\Service\User\UserRoleUpdate
     */
    protected $userRole;

    /**
     * 构造函数.
     *
     * @param \Common\Domain\Service\User\UserRoleUpdate $userRolew
     */
    public function __construct(UserRoleUpdate $userRole)
    {
        $this->userRole = $userRole;
    }

    /**
     * 响应方法.
     *
     * @param array $input
     *
     * @return array
     */
    public function handle(array $input): array
    {
        return $this->userRole->handle($input);
    }
}
