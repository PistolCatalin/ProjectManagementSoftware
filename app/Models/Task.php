<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Task extends Model
{
    use HasFactory;
    use Sortable;
    public function user(){
        return $this->belongsTo('App\Models\User',"assignedTo");
    }
    public function project(){
        return $this->belongsTo('App\Models\Project');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment');

    }
}
