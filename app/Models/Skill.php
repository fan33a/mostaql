<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory, SoftDeletes, Trans;

    protected $fillable = ['name', 'slug'];

    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
