<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'start_date', 'end_date'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
