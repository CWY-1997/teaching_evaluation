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
class Inspect extends Model
{
    protected $table = 'inspect'; //设置当前模型操作的数据表名
    /**
     * 查询学生论文情况
     */
    public function getInspect($stu_id){
        return Db::table('inspect')->where('a.stu_id ',$stu_id)->where('a.inspect_submi',0)->field('a.*,b.stu_name,b.user_number')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.inspect_id asc')->paginate(10);
    }
    /**
     * 查询学生选题论文总数
     */
    public function getInspectCount($stu_id){
        return Db::table('inspect')->where('a.stu_id ',$stu_id)->where('a.inspect_submi',0)->field('a.*,b.stu_name,b.user_number')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.inspect_id asc')->count();
    }

    /**
     * 论文材料上传
     */
    public function addInspect($data){
        return $this->save($data);
    }
    /**
     * 删除文件
     */
    public function deleInspect($inspect_id){
        return Db::table('inspect')->update(['inspect_submi' => '1','inspect_id'=>$inspect_id]);
    }

    /**
     * 根据论文ID修改为检查通过状态
     */
    public function examineAdopt($inspect_id){
        return Db::table('inspect')->update(['inspect_status' => 1,'inspect_remarks' =>'检查已通过','inspect_id'=>$inspect_id]);
    }
    /**
     * 根据论文ID修改为检查不通过状态
     */
    public function examineNotAdopt($inspect_id){
        return Db::table('inspect')->update(['inspect_status' =>2,'inspect_remarks' =>'检查不通过','inspect_id'=>$inspect_id]);
    }
}
