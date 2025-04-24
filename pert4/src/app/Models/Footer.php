<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;
    protected $footers ;
    protected $fillable = [
        'section',
        'label',
        'url',
        'order',
    ];
}
