<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MQueue extends Model
{
    use HasFactory;
    protected $table = 'queues';
    protected $guarded = [];
}
