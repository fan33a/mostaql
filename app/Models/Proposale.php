<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposale extends Model
{
    use HasFactory, SoftDeletes;

    public function freelasncer() {
        return $this->belongsTo(User::class, 'employee_id')->withDefault();
    }

    public function projcet() {
        return $this->belongsTo(Project::class)->withDefault();
    }

    public function proposale() {
        return $this->hasMany(Proposale::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class)->withDefault();
    }
}
