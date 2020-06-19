<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;

    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'employee_task_connection');
    }

}
