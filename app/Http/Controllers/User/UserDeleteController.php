<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserDeleteController extends Controller
{
    public function __invoke($id)
    {
        $user = User::find($id);

        if ($user === null) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ]);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ]);
    }
}
