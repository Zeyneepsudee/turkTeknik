<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();

        return Inertia::render('Home', [
            'services' => $services,
        ]);
    }
}
