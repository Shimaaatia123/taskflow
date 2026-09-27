<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'description_ar',
        'description_en',
        
    ];

    /**
     * The user who owns this project.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Users who are members of this project.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Tasks belonging to this project.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}