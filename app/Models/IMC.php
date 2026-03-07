<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * IMC Entity
 * @author Victor Ramos <httpsvictorramos@gmail.com>
 * @since 06/03/2026
 */
class IMC extends Model
{
    protected $table = 'imc';

    protected $fillable = [
        'height',
        'weight',
        'created_at',
        'user_id'
    ];
}
