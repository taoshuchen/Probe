<?php
/**
 * IDE Name: PhpStorm
 * Project : Probe
 * FileName: Operator.php
 * Author  : Li Tao
 * DateTime: 2018-02-22 05:16:00
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $connection = 'mysql';
    protected $table = 'operator';
    protected $primaryKey = 'id';
    public $timestamps = false;
}