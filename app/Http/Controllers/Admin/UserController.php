<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::orderByDesc('created_at')->get();

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
        ]);
    }
}
