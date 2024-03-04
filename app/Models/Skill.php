<?php

namespace App\Models;

use App\Trans\Trans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory, SoftDeletes, Trans;

    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
