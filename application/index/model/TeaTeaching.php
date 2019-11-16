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
class TeaTeaching extends Model
{
    protected $table = 'tea_teaching'; //设置当前模型操作的数据表名

    /**
     * 获取教师个人课程表
     * @return mixed
     */
    public function getTimetable($teaID){
        return Db::name('tea_teaching')->where('tea_id',$teaID)->where('teaching_apply_status',1)->field('a.teaching_status,a.teaching_id,b.*')->alias('a')->join('course_info b','a.course_id=b.course_id')->order('a.teaching_id asc')->paginate(10);
    }

    /**
     * 查询教师个人课程表总数
     */
    public function getTimetableCoure($teaID){
        return Db::table('tea_teaching')->where('tea_id',$teaID)->where('teaching_apply_status',1)->order('teaching_id desc')->count();
    }

    /**
     * 修改授课为正在授课
     */
    public function setBeingCourse($teachingId){
       return Db::table('tea_teaching')->update(['teaching_status' => 1,'teaching_id'=>$teachingId]);
    }

    /**
     * 修改授课为结束授课
     */
    public function setEndCourse($teachingId){
        return  Db::table('tea_teaching')->update(['teaching_status' => 2,'teaching_id'=>$teachingId]);
    }

    /**
     * 查询教师是否已经选课和选课状态
     */
    public function getCourseId($course_id,$tea_id){
        return Db::name('tea_teaching')->where('course_id',$course_id)->where('tea_id',$tea_id)->find();
    }

    /**
     * 教师申请加入课程
     */
    public function addPreselection($data){
        return $this->save($data);
    }

    /**
     * 检查教师是否有存在重复申请课程
     */
    public function inspectPreselection($data){
        $where = [
            'course_id'     => [ 'eq' , $data['course_id']] ,
            'tea_id'     => [ 'eq' , $data['tea_id']] ,
            'teaching_apply_status' => [ [ 'eq' , 0] , [ 'eq' , 1 ] , 'or' ] ,
        ];
        return Db::table('tea_teaching')->where($where)->find();
    }
    /**
     * 教师查询自己的授课课程学生加入情况
     */
    public function getTeaching($tea_id){
        return Db::name('tea_teaching')->where('tea_id',$tea_id)->order('course_id desc')->select();
    }
}
