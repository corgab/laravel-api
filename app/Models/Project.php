<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'project_url',
        'type_id',
        // 'technologies',
    ];

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function technologies() {

        return $this->belongsToMany('App\Models\Technology');
    }
}
