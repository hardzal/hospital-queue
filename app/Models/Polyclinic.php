<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polyclinic extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function queues()
    {
        return $this->hasMany(MQueue::class);
    }
}
