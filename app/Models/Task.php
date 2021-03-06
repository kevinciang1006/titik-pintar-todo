<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['section_id', 'name', 'state'];
    
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
       
    public function scopeSearch($query, $q)
    {
        return $query->where('name', 'like', '%' . $q . '%');
    }

    public function scopeState($query, $q)
    {
        if ($q == null) return $query;
        return $query->where('state', $q);
    }
}
