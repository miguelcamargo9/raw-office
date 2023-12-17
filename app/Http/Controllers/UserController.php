<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $activeUsers = User::active()->get();
        return response()->json($activeUsers);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:255',
        ]);

        try {
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->phone = $validatedData['phone'];
            $user->password = Hash::make('defaultPassword');
            $user->save();

            return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
        } catch (Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'User creation failed'], 500);
        }
    }

    public function show(User $user)
    {
    }

    public function update(Request $request, User $user)
    {
    }

    public function destroy(User $user)
    {
    }
}
