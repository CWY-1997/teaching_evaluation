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
class SelectedTopic extends Model
{
    protected $table = 'selected_topic'; //设置当前模型操作的数据表名
    /**
     * 查询学生选题情况
     */
    public function getTopic($stu_id){
        return Db::table('selected_topic')->where('a.topic_apply',0)->where('a.stu_id ',$stu_id)->field('a.*,b.stu_name,b.user_number')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.topic_id asc')->paginate(10);
    }
    /**
     * 查询学生选题情况总数
     */
    public function getTopicCount($stu_id){
        return Db::table('selected_topic')->where('a.topic_apply',0)->where('a.stu_id ',$stu_id)->field('a.*,b.stu_name,b.user_number')->alias('a')->join('stu_archives b','a.stu_id=b.stu_id')->order('a.topic_id asc')->count();
    }
    /**
     * 根据学生ID查询学生选题通过的信息
     */
    public function getTopicId($stu_id){
        return Db::table('selected_topic')->where('stu_id ',$stu_id)->where('topic_status ',1)->find();
    }
    /**
     * 选题材料上传
     */
    public function addTopicId($data){
        return $this->save($data);
    }
    /**
     * 删除文件
     */
    public function deleTopicId($topic_id){
        return Db::table('selected_topic')->update(['topic_apply' => '1','topic_id'=>$topic_id]);
    }

    /**
     * 根据选题ID修改为审核通过状态
     */
    public function examineAdopt($topic_id){
        return Db::table('selected_topic')->update(['topic_status' => 1,'topic_remarks' =>'审核已通过','topic_id'=>$topic_id]);
    }
    /**
     * 根据选题ID修改为审核不通过状态
     */
    public function examineNotAdopt($topic_id){
        return Db::table('selected_topic')->update(['topic_status' =>2,'topic_remarks' =>'审核不通过','topic_id'=>$topic_id]);
    }
}
