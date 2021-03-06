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

namespace Admin\App\Service\Permission;

use Common\Domain\Entity\Permission;
use Leevel\Collection\Collection;
use Leevel\Database\Ddd\IUnitOfWork;
use Leevel\Tree\Tree;

/**
 * 权限列表.
 *
 * @author Name Your <your@mail.com>
 *
 * @since 2017.11.23
 *
 * @version 1.0
 */
class Index
{
    /**
     * 事务工作单元.
     *
     * @var \Leevel\Database\Ddd\IUnitOfWork
     */
    protected $w;

    /**
     * 构造函数.
     *
     * @param \Leevel\Database\Ddd\IUnitOfWork $w
     */
    public function __construct(IUnitOfWork $w)
    {
        $this->w = $w;
    }

    /**
     * 响应方法.
     *
     * @return array
     */
    public function handle(): array
    {
        $repository = $this->w->repository(Permission::class);

        return $this->normalizeTree($repository->findAll());
    }

    /**
     * 将节点载入节点树并返回树结构.
     *
     * @param \Leevel\Collection\Collection $entitys
     *
     * @return array
     */
    protected function normalizeTree(Collection $entitys): array
    {
        return $this->createTree($entitys)->
        toArray(function (array $item) {
            return array_merge(['id' => $item['value'], 'expand' => true], $item['data']);
        });
    }

    /**
     * 生成节点树.
     *
     * @param \Leevel\Collection\Collection $entitys
     *
     * @return \Leevel\Tree\Tree
     */
    protected function createTree(Collection $entitys): Tree
    {
        return new Tree($this->parseToNode($entitys));
    }

    /**
     * 转换为节点数组.
     *
     * @param \Leevel\Collection\Collection $entitys
     *
     * @return array
     */
    protected function parseToNode(Collection $entitys): array
    {
        $node = [];

        foreach ($entitys as $e) {
            $node[] = [
                $e->id,
                $e->pid,
                $e->toArray(),
            ];
        }

        return $node;
    }
}
