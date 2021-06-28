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
    public function index(Request $request)
    {
        
        $properties = Property::orderBy('id', 'asc')->paginate(6);

        if($request->wantsJson()){
            return $properties;
        }

        return Inertia::render('Welcome', [
            'properties' => $properties,
        ]);
    }


}
