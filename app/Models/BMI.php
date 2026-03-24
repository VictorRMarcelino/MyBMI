<?php

namespace App\Models;

use App\Services\BMIService;
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

    /**
     * Return the relationed user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, BMI>
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getBodyMassIndexClassification() {
        return app(BMIService::class)->getBodyMassIndexClassification($this->result);
    }
}
