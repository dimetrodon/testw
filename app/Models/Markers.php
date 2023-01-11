<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Markers extends Model
{
    protected $table = "markers";
    public $timestamps = true;

    protected $fillable = [
        'lat',
        'lng',
    ];
    use HasFactory;
}
