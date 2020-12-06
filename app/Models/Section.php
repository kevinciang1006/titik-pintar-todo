<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory;
    use SoftDeletes;

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
    
    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($section) { // before delete() method call this
             $section->task()->delete();
             // do the rest of the cleanup...
        });

        // static::restoring(function($section) {
        //     $section->tasks()->withTrashed()->where('deleted_at', '>=', $section->deleted_at)->restore();
        // }); 
    }
}
