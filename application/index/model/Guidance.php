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
class Guidance extends Model
{
    protected $table = 'guidance'; //设置当前模型操作的数据表名

    /**
     * 根据选题ID查询教师信息
     */
    public function getGuidanceTeacher($stu_id){
        return Db::table('guidance')->where('a.stu_id ',$stu_id)->where('a.guidance_status',1)->field('a.*,b.tea_name,b.tea_phone')->alias('a')->join('teacher b','a.tea_id=b.tea_id')->find();
    }

    /**
     * 根据教师ID查询教师指导的所有学生选题信息
     */
    public function getGuidanceInfo($tea_id){
        return Db::table('guidance')
            ->where('a.tea_id ',$tea_id)
            ->where('a.guidance_status',1)
            ->field('a.guidance_status,b.*')
            ->alias('a')
            ->join('selected_topic b','a.stu_id=b.stu_id')
            ->order('b.topic_status asc')
            ->select();
    }

    /**
     * 根据教师ID查询教师指导的所有学生选题信息总数
     */
    public function getGuidanceInfoCount($tea_id){
        return Db::table('guidance')
            ->where('a.tea_id ',$tea_id)
            ->where('a.guidance_status',1)
            ->field('a.guidance_status,b.*')
            ->alias('a')
            ->join('selected_topic b','a.stu_id=b.stu_id')
            ->count();
    }

    /**
     * 根据教师ID查询教师指导的所有学生论文信息
     */
    public function getInspectInfo($tea_id){
        return Db::table('guidance')->where('a.tea_id ',$tea_id)->where('a.guidance_status',1)->field('a.guidance_status,b.*')->alias('a')->join('inspect b','a.stu_id=b.stu_id')->order('b.inspect_status asc')->select();
    }

    /**
     * 根据教师ID查询教师指导的所有学生论文信息总数
     */
    public function getInspectInfoCount($tea_id){
        return Db::table('guidance')->where('a.tea_id ',$tea_id)->where('a.guidance_status',1)->field('a.guidance_status,b.*')->alias('a')->join('inspect b','a.stu_id=b.stu_id')->count();
    }

    /**
     * 根据教师ID查询教师指导的所有学生论文答辩情况
     */
    public function getDefenceInfo($tea_id){
        return Db::table('guidance')->where('a.tea_id ',$tea_id)->where('a.guidance_status',1)->field('a.guidance_status,b.*')->alias('a')->join('defence b','a.stu_id=b.stu_id')->order('b.defence_status asc')->select();
    }

    /**
     * 根据教师ID查询教师指导的所有学生论文答辩情况总数
     */
    public function getDefenceCount($tea_id){
        return Db::table('guidance')->where('a.tea_id ',$tea_id)->where('a.guidance_status',1)->field('a.guidance_status,b.*')->alias('a')->join('defence b','a.stu_id=b.stu_id')->count();
    }

    /**
     * 根据教师ID查询教师指导的所有学生信息
     */
    public function getGuidanceStu($tea_id){
        return Db::table('guidance')->where('a.tea_id ',$tea_id)->field('a.guidance_id,a.guidance_status,a.guidance_year,b.*')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.guidance_status asc')->paginate(10);
    }

    /**
     * 根据教师ID查询教师指导的所有学生信息总数
     */
    public function getGuidanceStuCount($tea_id){
        return Db::table('guidance')->where('a.tea_id ',$tea_id)->field('a.guidance_id,a.guidance_status,a.guidance_year,b.*')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.guidance_status asc')->count();
    }

    /**
     * 添加指导学生信息
     */
    public function insertApplicant($data){
        return $this->save($data);
    }
    /**
     * 添加指导学生信息
     */
    public function delegGuidance($guidance_id){
        return db('guidance')->where('guidance_id',$guidance_id)->delete();
    }

    /**
     * 根据教师ID查出所有指导学生
     */
    public function getPreselectionStu($tea_id){
        return Db::table('guidance')->where('a.tea_id',$tea_id)->where('a.guidance_status',1)->field('a.guidance_id,b.*')->alias('a')->join('selected_topic b','a.stu_id=b.stu_id')->order('a.guidance_id  asc')->select();
    }
}
