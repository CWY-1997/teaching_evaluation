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
class TeaExcellent extends Model
{
    protected $table = 'tea_excellent'; //设置当前模型操作的数据表名
    /**
     * 优秀指导教师申请
     */
    public function excellentAdd($data){
        return $this->save($data);
    }
    /**
     * 获取教师申请材料信息
     * @return mixed
     */
    public function getExcellent(){
        return Db::name('tea_excellent')->where('tea_excellent_apply',0)->field('a.*,b.tea_name')->alias('a')->join('teacher b','a.tea_id=b.tea_id')->order('a.tea_excellent_id asc')->paginate(10);
    }

    /**
     * 查询教师申请材料总数
     */
    public function getExcellentCount(){
        return Db::table('tea_excellent')->where('tea_excellent_apply',0)->order('tea_excellent_id desc')->count();
    }

    /**
     * 根据ID查询申请状态
     * @return mixed
     */
    public function getExcellentId($id){
        return Db::table('tea_excellent')->where('tea_excellent_id',$id)->find();
    }
    /**
     * 根据ID删除申请材料
     * @return mixed
     */
    public function deleEvaluation($id){
        return Db::table('tea_excellent')->update(['tea_excellent_apply'=>1,'tea_excellent_id'=>$id]);
    }

    /**
 * 优秀教师申请审核通过
 */
    public function adoptEvaluation($id){
        return Db::table('tea_excellent')->update(['tea_excellent_status'=>1,'tea_excellent_id'=>$id]);
    }

    /**
     * 优秀教师申请审核不通过
     */
    public function notAdoptEvaluation($data){
        return Db::table('tea_excellent')->update(['tea_excellent_remarks'=>$data['tea_excellent_remarks'],'tea_excellent_status'=>2,'tea_excellent_id'=>$data['tea_excellent_id']]);
    }

}
