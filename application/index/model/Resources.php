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
class Resources extends Model
{
    protected $table = 'resources'; //设置当前模型操作的数据表名

    /**
     * 根据类型查询所有资源信息
     * @return \think\Paginator
     */
    public function getResources(){
        return Db::table('resources')->where('res_status',0)->field('a.*,b.tea_name')->alias('a')->join('teacher b','a.tea_id=b.tea_id')->order('a.res_id asc')->paginate(10);
    }
    /**
     * 根据类型查询资源信息总数
     */
    public function getResourcesCount(){
        return Db::table('resources')->where('res_status',0)->order('res_id asc')->count();
    }
    /**
     * 更新资源下载次数
     */
    public function upResourcesCount($id){
       return db('resources')->where('res_id',$id)->setInc('res_num',1); // 原数值加3
    }
}
