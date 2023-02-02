<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        return Inertia::render('Users', [
            'data' => User::all()->where('current_team_id',  '=', auth()->user()->current_team_id)
        ]);
    }
    
}
