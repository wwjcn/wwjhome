<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/12
 * Time: 17:01
 */
namespace app\common\model;

class AdminUser extends base
{
    /**
     * @desc 新增数据
     * @param array $data 新增数据
     * @return integer
     */
    public function add($data)
    {
        $this->data($data);
        return $this->save();
    }

    /**
     * @desc 新增数据
     * @param integer $pk 主键id值
     * @param array $data 新增数据
     * @return integer
     */
    public function edit($pk, $data)
    {
        return $this->where($this->pk, $pk)->update($data);
    }

    /**
     * @desc 获取详情
     * @param integer $pk 主键id值
     * @return array
     */
    public function getInfo($pk)
    {
        return $this->find($pk)->toArray();
    }

    /**
     * @desc 查询列表
     * @param array $param 条件参数
     * @return array
     */
    public function getList($param = array(), $isCount = false, $limit = array('offset' => 0, 'length' => 10))
    {
        $where = array();
        $result = array('count' => 0, 'data' => array());

        if (!empty($param['id'])) $where['id'] = $param['id'];
        if (!empty($param['username'])) $where['username'] = $param['username'];
        if (!empty($param['phone'])) $where['phone'] = $param['phone'];
        if (!empty($param['email'])) $where['email'] = $param['email'];

        if (!empty($param['order_by'])) {
            $orderBy = $param['order_by'];
        }else {
            $orderBy = 'user_id desc';
        }
        $result['count'] = $this->where($where)->count();
        if ($isCount) {
            return $result['count'];
        }
        $result['data'] = $this->where($where)
            ->order($orderBy)
            ->limit($limit['offset'], $limit['length'])
            ->select()
            ->toArray();
        return $result;
    }
}