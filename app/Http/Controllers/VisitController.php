<?php

namespace App\Http\Controllers;

use App\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function visits() {
        $visits = Visit::all();
        return RJM(['visits' => $visits], 1, 'success');
    }
}
