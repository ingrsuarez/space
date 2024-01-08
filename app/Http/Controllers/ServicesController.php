<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\Services;

class ServicesController extends Controller
{
    
    public function new()
    {

        return view('services.new');
    }

    public function store(Request $request)
    {
        $service = new Services;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->area = $request->area;
        $service->path = $request->path;
        $service->save();

        return back()->with('message', 'Servicio agregado correctamente!');

    }


}
