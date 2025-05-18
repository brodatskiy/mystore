<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateRequest;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function update(UpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['avatar'])) {
            $data['avatar'] = Storage::disk('public')->put('/images', $data['avatar']);
        }

        $request->user()->update($data);

        return back()->with('message', __('You have updated your profile.'));
    }

    /**
     * @throws Exception
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
