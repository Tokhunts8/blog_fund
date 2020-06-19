<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeTaskConnection extends Model
{
    public $timestamps = false;
    protected $table = 'employee_task_connection';
}
