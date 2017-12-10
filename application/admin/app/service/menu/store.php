<?php
// (c) 2018 http://your.domain.com All rights reserved.
namespace admin\app\service\menu;

use common\is\tree\tree;
use admin\domain\entity\admin_menu as entity;
use admin\is\repository\admin_menu as repository;

/**
 * 后台菜单新增保存
 *
 * @author Name Your <your@mail.com>
 * @package $$
 * @since 2017.10.12
 * @version 1.0
 */
class store
{

    /**
     * 后台菜单仓储
     *
     * @var \admin\is\repository\admin_menu
     */
    protected $oRepository;

    /**
     * 构造函数
     *
     * @param \admin\is\repository\admin_menu $oRepository
     * @return void
     */
    public function __construct(repository $oRepository)
    {
        $this->oRepository = $oRepository;
    }

    /**
     * 响应方法
     *
     * @param array $aMenu
     * @return mixed
     */
    public function run($aMenu)
    {
        $aMenu['pid'] = $this->parseParentId($aMenu['pid']);
        return $this->oRepository->create($this->entity($aMenu));
    }

    /**
     * 创建实体
     *
     * @param array $aMenu
     * @return \admin\domain\entity\admin_menu
     */
    protected function entity(array $aMenu)
    {
        $aMenu['sort'] = $this->parseSiblingSort($aMenu['pid']);
        return new entity($this->data($aMenu));
    }

    /**
     * 组装 POST 数据
     *
     * @param array $aMenu
     * @return array
     */
    protected function data(array $aMenu)
    {
        return [
            'pid' => intval($aMenu['pid']),
            'title' => trim($aMenu['title']),
            'name' => trim($aMenu['name']),
            'path' => trim($aMenu['path']),
            'sort' => intval($aMenu['sort']),
            'status' => $aMenu['status'] === true ? 'enable' : 'disable',
            'component' => trim($aMenu['component']),
            'icon' => trim($aMenu['icon']),
            'app' => trim($aMenu['app']),
            'controller' => trim($aMenu['controller']),
            'action' => trim($aMenu['action']),
            'button' => $aMenu['button'] === true ? 'T' : 'F',
        ];
    }

    /**
     * 分析父级数据
     *
     * @param array $aPid
     * @return int
     */
    protected function parseParentId(array $aPid)
    {
        $intPid = intval(array_pop($aPid));
        if ($intPid < 0) {
            $intPid = 0;
        }

        return $intPid;
    }

    /**
     * 分析兄弟节点最靠下面的排序值
     *
     * @param int $nPid
     * @return int
     */
    protected function parseSiblingSort($nPid)
    {
        $mixSibling = $this->oRepository->siblingNodeBySort($nPid);
        return $mixSibling ? $mixSibling->sort-1 : 500;
    }
}
