<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUploadImageRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class UserUploadImageController extends Controller
{
    public function __invoke(UserUploadImageRequest $request, $id)
    {
        $user = User::find($id);

        if ($user === null) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        $file = $request->file('image');
        $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();

        Storage::disk('public')->putFileAs('image', $file, $filename);
        $user->image = Storage::disk('public')->url('image/'.$filename);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully',
            'data' => $user
        ]);
    }
}
