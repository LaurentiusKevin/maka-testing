<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserViewImageController extends Controller
{
    public function __invoke($path)
    {
        $image = Storage::url($path);

        return $image;
    }
}
