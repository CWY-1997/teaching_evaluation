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
class CourseSubmi extends Model
{
    protected $table = 'course_submi'; //设置当前模型操作的数据表名

    /**
     *查询提交的学生
     * @param $teaID
     * @return \think\Paginator
     */
    public function getSubmiInfo($ass_id){
        return Db::name('course_submi')->where('ass_id',$ass_id)->field('a.*,b.stu_name,b.user_number')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.course_submi_id asc')->paginate(10);
    }

    /**
     * 查询教师个人课程表总数
     */
    public function getSubmiInfoCount($ass_id){
        return Db::table('course_submi')->where('ass_id',$ass_id)->order('course_submi_id desc')->count();
    }
}
