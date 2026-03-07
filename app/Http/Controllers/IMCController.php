<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * IMC Controller
 * @author Victor Ramos <httpsvictorramos@gmail.com>
 * @since 06/03/2026
 */
class ImcController extends Controller
{
    /** Renderize the IMC view */
    public function index() {
        Route::inertia('IMC', [
            'historyRegister' => []
        ]);
    }

    public function store(Request $oRequest) {

    }

    public function update(Request $oRequest) {

    }

    public function delete(Request $oRequest) {
        
    }
}
