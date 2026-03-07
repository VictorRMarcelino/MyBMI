<?php

namespace App\Http\Controllers;

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
        return Inertia::render('IMC', [
            'historyRegister' => []
        ]);
    }

    /**
     * Insert a new IMC item
     * @param Request $oRequest
     * @return void
     */
    public function store(Request $oRequest) {
        $user_id = Auth::id();
        $aAttributes = $oRequest->validate([
            "height" => 'required|numeric|min:0.1',
            "wheight" => 'required|numeric|min:0.1'
        ]);

        $aAttributes['created_at'] = date('d/m/Y h:i:s');
        $aAttributes['user_id'] = $user_id;
        BMI::create($aAttributes);
    }
}
