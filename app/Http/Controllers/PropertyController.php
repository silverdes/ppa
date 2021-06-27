<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Welcome', [
            'properties' => Property::all(),
        ]);
    }
}
