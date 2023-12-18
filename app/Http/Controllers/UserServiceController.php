<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $apiKey = env('API_KEY', 'default_api_key');
        $apiUrl = env('API_URL', 'http://localhost');
        $responseArray = Http::withHeaders(['API-KEY' => $apiKey])->get($apiUrl . '/api/users')->json();
        return response()->json($responseArray);
    }
}
