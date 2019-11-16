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
class StuExcellent extends Model
{
    protected $table = 'stu_excellent'; //设置当前模型操作的数据表名
    /**
     * 获取学生申请材料信息
     * @return mixed
     */
    public function getExcellent(){
        return Db::name('stu_excellent')->where('stu_excellent_apply',0)->field('a.*,b.stu_name')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.stu_excellent_id asc')->paginate(10);
    }

    /**
     * 查询申请材料总数
     */
    public function getExcellentCount(){
        return Db::table('stu_excellent')->where('stu_excellent_apply',0)->order('stu_excellent_id desc')->count();
    }
    /**
     * 优秀毕业生申请
     */
    public function excellentAdd($data){
        return $this->save($data);
    }

    /**
     * 根据ID查询申请状态
     * @return mixed
     */
    public function getExcellentId($id){
        return Db::table('stu_excellent')->where('stu_excellent_id',$id)->find();
    }
    /**
     * 根据ID删除申请材料
     * @return mixed
     */
    public function deleEvaluation($id){
        return Db::table('stu_excellent')->update(['stu_excellent_apply'=>1,'stu_excellent_id'=>$id]);
    }

    /**
 * 优秀学生申请审核通过
 */
    public function adoptEvaluation($id){
        return Db::table('stu_excellent')->update(['stu_excellent_status'=>1,'stu_excellent_id'=>$id]);
    }

    /**
     * 优秀学生申请审核不通过
     */
    public function notAdoptEvaluation($data){
        return Db::table('stu_excellent')->update(['stu_examine_remarks'=>$data['stu_examine_remarks'],'stu_excellent_status'=>2,'stu_excellent_id'=>$data['stu_excellent_id']]);
    }
}
