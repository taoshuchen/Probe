<?php
/**
 * IDE Name: PhpStorm
 * Project : Probe
 * FileName: ActionLog.php
 * Author  : Li Tao
 * DateTime: 2018-02-11 09:15:00
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActionLog extends Model
{
    protected $connection = 'mysql';
    protected $table = 'action_log';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['user_id', 'action', 'remark',];

    const ACTION_LOGIN = 1;
    const ACTION_LOGOUT = 2;
    const ACTION_CREATE_ROLE = 3;
    const ACTION_EDIT_ROLE = 4;
    const ACTION_DELETE_ROLE = 5;
    const ACTION_CREATE_PERMISSION = 6;
    const ACTION_EDIT_PERMISSION = 7;
    const ACTION_DELETE_PERMISSION = 8;
    const ACTION_CREATE_USER = 9;
    const ACTION_EDIT_USER = 10;
    const ACTION_DELETE_USER = 11;

    public static $actionMap = [
        self::ACTION_LOGIN => '登录',
        self::ACTION_LOGOUT => '退出',
        self::ACTION_CREATE_ROLE => '创建角色',
        self::ACTION_EDIT_ROLE => '编辑角色',
        self::ACTION_DELETE_ROLE => '删除角色',
        self::ACTION_CREATE_PERMISSION => '创建权限',
        self::ACTION_EDIT_PERMISSION => '编辑权限',
        self::ACTION_DELETE_PERMISSION => '删除权限',
        self::ACTION_CREATE_USER => '创建用户',
        self::ACTION_EDIT_USER => '编辑用户',
        self::ACTION_DELETE_USER => '删除用户',
    ];

    /**
     * @author Li Tao
     * @param $action
     * @param string $remark
     * @return $this|Model
     */
    public static function log($action, $remark = '')
    {
        $user = Auth::user();
        if (isset($user) && isset($user->id)) {
            $userId = $user->id;
            $actionLog = (new ActionLog)->create([
                'user_id' => $userId,
                'action' => $action,
                'remark' => $remark,
            ]);
            return $actionLog;
        }
        return null;
    }

    public static function listActionLog($page = 1, $size = 10)
    {
        $db = (new ActionLog)
            ->leftJoin('users', 'action_log.user_id', '=', 'users.id');
        $count = $db->count();
        $actionLogList = $db->select('action_log.*', 'users.name')
            ->orderBy('action_log.id', 'desc')
            ->forPage($page, $size)
            ->get();
        $data = [];
        $data['count'] = $count;
        $data['actionLogList'] = $actionLogList;
        return $data;
    }

}