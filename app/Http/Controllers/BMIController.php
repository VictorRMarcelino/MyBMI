<?php

namespace App\Http\Controllers;

use App\Http\Requests\BMIStoreRequest;
use App\Models\BMI;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
     */
    public function store(BMIStoreRequest $oRequest) {
        $user_id = Auth::id();
        $attributes = $oRequest->validated();
        $attributes['created_at'] = date('d/m/Y h:i:s');
        $attributes['user_id'] = $user_id;
        $attributes['result'] = $this->calculateBodyMassIndex($attributes['height'], $attributes['weight']);
        BMI::create($attributes);
        $bmi = $attributes['result'];
        $messageResult = sprintf('Your Body Mass Index (BMI) is: %f. You are classified as: %s', $bmi, $this->getBodyMassIndexClassification($bmi));
    }

    /**
     * Calculate the body mass index
     * @param float $height
     * @param float $weight
     * @return float|int
     */
    private function calculateBodyMassIndex($height, $weight) {
        return round($weight / (pow($height, 2)), 1);
    }

    /**
     * Return the classification indicated by the BMI
     * @param float $bodyMassIndex
     * @return string
     */
    private function getBodyMassIndexClassification($bodyMassIndex) {
        switch (true) {
            case ($bodyMassIndex < 18.5):
                return 'Underweight';
            case ($bodyMassIndex > 18.5 && $bodyMassIndex < 24.9):
                return 'Healthy Weight';
            case ($bodyMassIndex > 25 && $bodyMassIndex < 29.9):
                return 'Overweight';
            case ($bodyMassIndex > 30 && $bodyMassIndex < 34.9):
                return 'Obesity I';
            case ($bodyMassIndex > 35 && $bodyMassIndex < 39.9):
                return 'Obesity II';
            default:
                return 'Obesity III (Very Severe/Morbid)';
        }
    }
}
