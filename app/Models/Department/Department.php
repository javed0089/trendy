<?php

namespace App\Models\Department;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function Jobs()
    {
    	return $this->hasMany('App\Models\Careers\Job','department_id');
    }


    public function JobCount($id)
    {
    	$deptJobCount=0;
    	$deptJobCount=count($this->Jobs->where('job_status','=','1'));
    	return $deptJobCount;
    }
}
