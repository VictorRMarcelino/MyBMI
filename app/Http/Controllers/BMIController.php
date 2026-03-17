<?php

namespace App\Http\Controllers;

use App\Http\Requests\BMIStoreRequest;
use App\Http\Resources\BMIResource;
use App\Models\BMI;
use App\Services\BMIService;
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

    private $BMIService;

    /**
     * @inheritDoc
     * @param BMIService $BMIService
     */
    public function __construct(BMIService $BMIService) {
        $this->BMIService = $BMIService;
    }

    /** Renderize the IMC view */
    public function index() {
        $user = Auth::user();
        $historyRegister = $user->bmi()->limit(5)->orderByDesc('created_at')->get();

        return Inertia::render('BMI', [
            'historyRegister' => BMIResource::collection($historyRegister)->resolve()
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
        $attributes['result'] = $this->BMIService->calculateBodyMassIndex($attributes['height'], $attributes['weight']);
        BMI::create($attributes);
        $bmi = $attributes['result'];
        $messageResult = sprintf('Your Body Mass Index (BMI) is: %f. You are classified as: %s', $bmi, $this->BMIService->getBodyMassIndexClassification($bmi));
        return redirect()->route('bmi.index')->with('message', $messageResult);
    }
}
