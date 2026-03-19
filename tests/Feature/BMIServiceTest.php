<?php

namespace Tests\Feature;

use App\Services\BMIService;
use Tests\TestCase;

class BMIServiceTest extends TestCase
{
    /** Test a case of the BMI calc */
    public function test_calculate_body_mass_index(): void{
        $BMIService = new BMIService();
        $result = $BMIService->calculateBodyMassIndex(1.7, 70);
        $this->assertEquals(24.22, $result);
    }
}
