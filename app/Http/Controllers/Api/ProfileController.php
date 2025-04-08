<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{

    public function index()
    {
        $user = auth('api')->user();

        return $this->apiResponse(
            new UserResource($user)
        );
    }
}
