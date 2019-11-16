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
class GraduationAchievement extends Model
{
    protected $table = 'graduation_achievement'; //设置当前模型操作的数据表名

    /**
     * 查询学生的毕业设计所有成绩
     */
    public function getGradAchie($stu_id){
        return Db::name('graduation_achievement')->where('a.stu_id',$stu_id)->field('a.*,b.topic_subject')->alias('a')->join('selected_topic b','a.topic_id=b.topic_id')->order('a.grad_id asc')->find();
    }

}
