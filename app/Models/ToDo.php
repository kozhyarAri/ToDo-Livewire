<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    protected $fillable = [
        'name',
        'completed',
        'image'
    ];
    use HasFactory;
}
