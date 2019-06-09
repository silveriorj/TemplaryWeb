<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemolayController extends Controller {

    public function listar() {
        return view('demolay');
    }
}
