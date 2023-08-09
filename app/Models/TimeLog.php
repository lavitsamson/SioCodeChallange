<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user() {
        return $this->blongsTo(User::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
