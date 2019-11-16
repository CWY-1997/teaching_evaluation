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
class StuArchives extends Model
{
    protected $table = 'stu_archives'; //设置当前模型操作的数据表名

    /**
     * 根据学生ID查询学生信息
     */
    public function getArchivesId($stu_id){
        return Db::table('stu_archives')->where('stu_id',$stu_id)->find();
    }
    /**
     * 根据学生学号查询学生信息
     */
    public function getArchivesNumber($user_number){
        return Db::table('stu_archives')->where('user_number',$user_number)->find();
    }
}
