<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserReadController extends Controller
{
    public function __invoke()
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'message' => 'List all user',
            'data' => $users
        ]);
    }
}
