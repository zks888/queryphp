<?php

declare(strict_types=1);

/*
 * This file is part of the forcodepoem package.
 *
 * The PHP Application Created By Code Poem. <Query Yet Simple>
 * (c) 2018-2099 http://forcodepoem.com All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Common\Infra\Repository;

use Leevel\Database\Ddd\Repository;
use Leevel\Database\Ddd\Select;

/**
 * 权限仓储.
 *
 * @author Xiangmin Liu <635750556@qq.com>
 *
 * @since 2018.10.27
 *
 * @version 1.0
 */
class Permission extends Repository
{
    /**
     * 是否存在子项.
     *
     * @param int $id
     *
     * @return bool
     */
    public function hasChildren(int $id): bool
    {
        return $this->findCount(function (Select $select) use ($id) {
            $select->where('pid', $id);
        }) > 0;
    }
}
