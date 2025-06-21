<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserUpdateController extends Controller
{
    public function __invoke(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);

        if ($user === null) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        if ($request->has('name')) {
            $isNameExists = User::query()
                ->whereNot('id', $user->id)
                ->where('name', $request->name)
                ->exists();

            if ($isNameExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Name already exists',
                ], 422);
            }

            $user->name = $request->name;
        }

        if ($request->has('address')) {
            $user->address = $request->address;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }
}
