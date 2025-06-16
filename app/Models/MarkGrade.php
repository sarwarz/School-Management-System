<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarkGrade extends Model
{
    protected $fillable = [
        'name',
        'point',
        'percent_from',
        'percent_upto',
        'remarks',
        'status',
    ];

    public static function getByPercentage($percent)
    {
        return self::where('percent_from', '<=', $percent)
            ->where('percent_upto', '>=', $percent)
            ->first();
    }
}
