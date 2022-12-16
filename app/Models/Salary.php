<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    public function department(){
        return $this->belongsToMany(Department::class,'salary_departments','department_id','salary_id');
    }

}
