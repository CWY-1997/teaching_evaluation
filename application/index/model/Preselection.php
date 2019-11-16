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
class Preselection extends Model
{
    protected $table = 'preselection'; //设置当前模型操作的数据表名
    /**
     * 申请加入课程
     */
    public function addPreselection($data){
        return $this->save($data);
    }

    /**
     * 检查学生是否已经加入过课程
     */
    public function inspectPreselection($data){
        $where = [
            'course_id'     => [ 'eq' , $data['course_id']] ,
            'stu_id'     => [ 'eq' , $data['stu_id']] ,
            'prese_status' => [ [ 'eq' , 0] , [ 'eq' , 1 ] , 'or' ] ,
        ];
        return Db::table('preselection')->where($where)->order('prese_id desc')->find();
    }

    /**
     * 查询学生是否选课和选课状态
     */
    public function getCourseId($course_id,$stu_id){
        return Db::name('preselection')->where('course_id',$course_id)->where('stu_id',$stu_id)->order('prese_id desc')->find();
    }


    /**
     * 查询学生课程表
     */
    public function getHard($stu_id){
        return Db::table('preselection')->where('prese_status',1)->where('stu_id',$stu_id)->field('a.*,b.*')->alias('a')->join('course_info b','a.course_id=b.course_id')->order('b.course_year asc')->paginate(10);
    }
    /**
     * 查询学生课程表总数
     */
    public function getHardCount($stu_id){
        return Db::table('preselection')->where('prese_status',1)->where('stu_id ',$stu_id)->field('a.*,b.*')->alias('a')->join('course_info b','a.course_id=b.course_id')->order('b.course_year asc')->count();
    }

    /**
     * 根据课程号查出所有审核通过学生加入信息
     */
    public function getPreselectionStu($course_id){
        return Db::table('preselection')->where('a.course_id',$course_id)->where('a.prese_status',1)->field('a.prese_status,a.course_id,b.*')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.prese_id  asc')->paginate(10);
    }
    /**
     * 根据课程号查出所有学生加入信息
     */
    public function getPreselectionStuAll($course_id){
        return Db::table('preselection')->where('a.course_id',$course_id)->field('a.prese_status,a.course_id,b.*')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.prese_status asc')->paginate(10);
    }
    /**
     * 根据课程号查出所有审核通过学生加入信息
     */
    public function getPreselectionStuCount($course_id){
        return Db::table('preselection')->where('a.course_id',$course_id)->where('a.prese_status',1)->field('a.prese_status,a.course_id,b.*')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.prese_id  asc')->count();
    }
}
