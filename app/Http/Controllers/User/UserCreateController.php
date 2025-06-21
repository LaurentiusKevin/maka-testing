<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class UserCreateController extends Controller
{
    public function __invoke(UserCreateRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->address = $request->address;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('image', $file, $filename);
            $user->image = Storage::disk('public')->url('image/'.$filename);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ]);
    }
}
