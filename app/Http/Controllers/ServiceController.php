<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();

        return Inertia::render('Services/Index', [
            'services' => $services,
        ]);
    }

    public function show(Service $service)
    {
        if (! $service->is_active) {
            abort(404);
        }

        return Inertia::render('Services/Show', [
            'service' => $service,
        ]);
    }
}
