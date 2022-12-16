<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public function salary(){
        return $this->belongsToMany(Salary::class,'salary_departments','salary_id','department_id')->where('specified','1');
    }

    public function salarySpecified(){
        return $this->hasMany(SalaryDepartment::class)->where('specified','1')->withAggregate('salary','salary');
    }
}
