<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Helpers\Helper;
use App\Http\Resources\UserResource;
use Auth;

class LoginController extends Controller
{
    /**
     * Login User
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="user_id", type="number"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="balance", type="number"),
     *                 @OA\Property(property="active", type="boolean"),
     *                 @OA\Property(property="token", type="string"),
     *                 @OA\Property(property="roles", type="array", @OA\Items()),
     *                 @OA\Property(property="roles.permissions", type="array", @OA\Items()),
     *                 @OA\Property(property="permissions", type="array", @OA\Items())
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(
     *                 property="data", type="object",
     *                 @OA\Property(
     *                     property="string", type="array",
     *                     @OA\Items(type="string")
     *                 )
     *             )
     *         )
     *     ),
     *    @OA\Response(
     *        response=401,
     *        description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(
     *                 property="data", type="object",
     *                 @OA\Property(
     *                     property="string", type="array",
     *                     @OA\Items(type="string")
     *                 )
     *             )
     *         )
     *      )
     *    )
     */
    public function login(LoginRequest $request)
    {
        // login user
        if(!Auth::attempt($request->only('email','password'))){
            Helper::sendError('Email Or Password is wroing !!!');
        }
        // send response
        return new UserResource(auth()->user());
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return Helper::sendSuccess('Logout Successfully',[],200);
    }
}
