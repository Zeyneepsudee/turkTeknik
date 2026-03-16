<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class AdminDashboardController extends Controller
{
    public function index(): Response
    {
        $totalUsers = User::count();
        $totalServiceRequests = ServiceRequest::count();
        $serviceRequestsByDay = ServiceRequest::selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->orderBy('day', 'desc')
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'totalUsers' => $totalUsers,
            'totalServiceRequests' => $totalServiceRequests,
            'serviceRequestsByDay' => $serviceRequestsByDay,
        ]);
    }
}
