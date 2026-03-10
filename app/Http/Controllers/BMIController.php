<?php

namespace App\Http\Controllers;

use App\Http\Requests\BMIStoreRequest;
use App\Models\BMI;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * BMI Controller
 * @author Victor Ramos <httpsvictorramos@gmail.com>
 * @since 06/03/2026
 */
class BMIController extends Controller
{
    /** Renderize the IMC view */
    public function index() {
        return Inertia::render('BMI', [
            'historyRegister' => BMI::where('user_id', Auth::id())->get()
        ]);
    }

    /**
     * Insert a new IMC item
     * @param Request $oRequest
     * @return void
     */
    public function store(BMIStoreRequest $oRequest) {
        $user_id = Auth::id();
        $attributes = $oRequest->validated();
        $attributes['created_at'] = date('d/m/Y h:i:s');
        $attributes['user_id'] = $user_id;
        $attributes['result'] = $this->calculateBodyMassIndex($attributes['height'], $attributes['weight']);
        BMI::create($attributes);
    }

    /**
     * Calculate the body mass index
     * @param float $height
     * @param float $weight
     * @return float|int
     */
    private function calculateBodyMassIndex($height, $weight) {
        return round($weight / (pow($height, 2)), 2);
    }
}
