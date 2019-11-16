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
class Classes extends Model
{
    protected $table = 'classes'; //设置当前模型操作的数据表名
    public function getClassesNmae($classes_id){
        return Db::table('classes')->where('classes_id',$classes_id)->find();
    }
}
