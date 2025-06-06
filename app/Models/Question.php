<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'quiz_id',
        'question',
        'type',
        'score',
        'order_num',
        'active'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function options() {
        
        return $this->hasMany(Option::class);
    }
}
