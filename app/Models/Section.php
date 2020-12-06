<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    public function task()
    {
        return $this->hasMany('App\Models\Task');
    }
    
    public function scopeSearch($query, $q)
    {
        return $query->where('name', 'like', '%' . $q . '%');
    }
    
    public function scopeTaskId($query, $q)
    {
        if ($q == null) return $query;
        return $query->whereHas('task', function($task) use ($q) {
            $task->where('id',  $q);
        });
    }
    
}
