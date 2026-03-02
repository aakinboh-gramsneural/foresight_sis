<?php

namespace App\Http\Controllers;

use App\Models\ServiceSection;

class ServiceController extends Controller
{
    public function __invoke()
    {
        return view('pages.services', [
            'sections' => ServiceSection::orderBy('order')->get(),
        ]);
    }
}
