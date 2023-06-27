<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table = 'budgets';
    protected $primaryKey = 'userid';
    protected $fillable = [
        'userid'
        
    ];
    use HasFactory;
}
