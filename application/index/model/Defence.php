<?php
/**
 * @creDate :2019/09/27
 * @function: 登陆验证
 * @author  :陈文艺
 * @editor  :修改人
 * @modDate :修改日期
 * @version :V0.1.0
 * @team    :TuboSnail
 */
namespace app\index\model;
use think\Model;
use think\Db;
class Defence extends Model
{
    protected $table = 'defence'; //设置当前模型操作的数据表名
    /**
     * 查询学生选题情况
     */
    public function getDefence($stu_id){
        return Db::table('defence')->where('a.stu_id ',$stu_id)->field('a.*,b.stu_name,b.user_number')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.defence_id asc')->paginate(10);
    }
    /**
     * 查询学生选题情况总数
     */
    public function getDefenceCount($stu_id){
        return Db::table('defence')->where('a.stu_id ',$stu_id)->field('a.*,b.stu_name,b.user_number')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.defence_id asc')->count();
    }

    /**
     * 根据 论文答辩ID修改为答辩通过状态
     */
    public function examineAdopt($defence_id){
        return Db::table('defence')->update(['defence_status' => 1,'defence_id'=>$defence_id]);
    }
    /**
     * 根据 论文答辩ID修改为答辩不通过状态
     */
    public function examineNotAdopt($defence_id){
        return Db::table('defence')->update(['defence_status' =>2,'defence_id'=>$defence_id]);
    }
}
