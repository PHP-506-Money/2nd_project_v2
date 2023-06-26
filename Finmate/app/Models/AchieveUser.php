<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchieveUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid'
        
    ];

    public $timestamps = false;
}
