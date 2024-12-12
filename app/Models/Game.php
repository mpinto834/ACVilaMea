<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'team1_name',
        'team1_photo',
        'team2_name',
        'team2_photo',
        'location',
        'date_time',
        'result'
    ];

    protected $casts = [
        'date_time' => 'datetime'
    ];
}