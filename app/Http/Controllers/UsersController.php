<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return Response::json(['error' => 'Unauthorized'], 401);
        }
        $teamId = $user->current_team_id;
        $users = User::where('current_team_id', $teamId)->get();
        return Response::json(['data' => $users]);
    }
}
