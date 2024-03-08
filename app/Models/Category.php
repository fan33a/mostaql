<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Project;

class Category extends Model
{
    use HasFactory, SoftDeletes, Trans; // Trans Custom Class For Translating

    protected $fillable = ['name', 'slug'];

    public function projects() {
        return $this->hasMany(Project::class);
    }
}
