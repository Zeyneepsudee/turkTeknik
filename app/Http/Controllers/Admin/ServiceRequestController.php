<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Inertia\Inertia;
use Inertia\Response;

class ServiceRequestController extends Controller
{
    public function index(): Response
    {
        $serviceRequests = ServiceRequest::with(['user', 'product'])->orderByDesc('created_at')->get();

        return Inertia::render('Admin/ServiceRequests/Index', [
            'serviceRequests' => $serviceRequests,
        ]);
    }
}
