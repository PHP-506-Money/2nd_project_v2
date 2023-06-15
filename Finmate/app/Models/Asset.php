<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Asset extends Model
{
    protected $table = 'assets';
    protected $primaryKey = 'id';
    protected $fillable = ['type', 'name', 'description'];
}
