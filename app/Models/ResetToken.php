<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetToken extends Model
{
    protected $fillable = ['token', 'expires_at'];
    protected $dates = ['expires_at'];
}

