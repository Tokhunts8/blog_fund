<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = false;

    public function employees()
    {
        return $this->belongsToMany('App\Employee', 'employee_task_connection');
    }

    public function progress()
    {
        return $this->belongsTo('App\TaskProgressTypes', 'progress_id', 'id');
    }
}
