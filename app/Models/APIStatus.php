<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APIStatus extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'api_status';

    protected $fillable = [
        'status', 'memoryConsumed', 'date'
    ];
}
