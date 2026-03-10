<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * BMI Entity
 * @author Victor Ramos <httpsvictorramos@gmail.com>
 * @since 06/03/2026
 */
class BMI extends Model
{
    protected $table = 'bmi';

    const UPDATED_AT = null;

    protected $fillable = [
        'height',
        'weight',
        'result',
        'created_at',
        'user_id'
    ];
}
