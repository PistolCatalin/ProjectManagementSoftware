<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Project extends Model
{
    use HasFactory;
    use Sortable;
   
    public $sortable = ['name',
    'startDate',
    'created_at',
    'duration'];

    public function tasks(){
        return $this->hasMany('App\Models\Task');
    }
}
