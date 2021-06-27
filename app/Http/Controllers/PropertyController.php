<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    //
    public function index()
    {
        $properties = Property::orderBy('id', 'desc')->paginate(2);
        return Inertia::render('Welcome', [
            'properties' => $properties,
        ]);
    }

    
}
