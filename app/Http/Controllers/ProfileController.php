<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$request->user()->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'profile_picture' => ['nullable', 'image', 'max:1024'], // max 1MB
        ]);

        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }

            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return Redirect::route('profile')->with('success', 'Profil başarıyla güncellendi.');
    }

    public function show(Request $request): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $serviceRequests = ServiceRequest::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->with('product')
            ->get();

        return Inertia::render('Profile', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
                'email_verified_at' => $user->email_verified_at,
                // diğer gerekli alanlar...
            ],
            'serviceRequests' => $serviceRequests->map(function ($request) {
                return [
                    'id' => $request->id,
                    'request_number' => $request->request_number,
                    'service_type' => $request->service_type,
                    'service_option' => $request->service_option,
                    'status' => $request->status,
                    'status_text' => $request->status_text,
                    'created_at' => $request->created_at->toDateTimeString(),
                    'product' => $request->product ? [
                        'name' => $request->product->name,
                        'category' => $request->product->category,
                    ] : null,
                ];
            }),
        ]);
    }
}
