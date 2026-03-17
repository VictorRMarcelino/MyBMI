<?php

namespace App\Services;

class BMIService {

    /**
     * Calculate the body mass index
     * @param float $height
     * @param float $weight
     * @return float|int
     */
    public function calculateBodyMassIndex($height, $weight) {
        return round($weight / (pow($height, 2)), 2);
    }

    /**
     * Return the classification indicated by the BMI
     * @param float $bodyMassIndex
     * @return string
     */
    public function getBodyMassIndexClassification($bodyMassIndex) {
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