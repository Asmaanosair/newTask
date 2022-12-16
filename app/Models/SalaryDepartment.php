<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDepartment extends Model
{
    use HasFactory;

    public function salary(){
        return $this->hasMany(Salary::class,'id','salary_id');
    }
    public function departmentSalary(){
        return $this->hasOne(Salary::class,'id','salary_id');
    }
}
