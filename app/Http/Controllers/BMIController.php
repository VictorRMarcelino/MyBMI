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
        $user = Auth::user();

        return Inertia::render('BMI', [
            'historyRegister' => $user->bmi()->limit(10)->orderByDesc('created_at')->get()
        ]);
    }

    /**
     * Insert a new IMC item
     * @param Request $oRequest
     */
    public function store(BMIStoreRequest $oRequest) {
        $user_id = Auth::id();
        $attributes = $oRequest->validated();
        $attributes['created_at'] = date('Y-m-d H:i:s');
        $attributes['user_id'] = $user_id;
        $attributes['result'] = $this->calculateBodyMassIndex($attributes['height'], $attributes['weight']);
        BMI::create($attributes);
        $bmi = $attributes['result'];
        $messageResult = sprintf('Your Body Mass Index (BMI) is: %f. You are classified as: %s', $bmi, $this->getBodyMassIndexClassification($bmi));
        return redirect()->route('bmi.index')->with('message', $messageResult);
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
