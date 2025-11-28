<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->type !== 'admin') {
            abort(404);
        }
        return Inertia::render('Admin/Users/UserIndex', [
            'users' => UserResource::collection(User::all())
        ]);
    }

public function destroy(User $user)
    {
        if (auth()->user()->type !== 'admin') {
            abort(404);
        }

        try {
            // Delete the user
            $user->delete();

            return redirect()->back()
                ->with('success', 'User successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
}