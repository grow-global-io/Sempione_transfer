<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /**
     * Register User
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
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

    public function register(RegisterRequest $request)
    {
        // register user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'active' => 1,
            'balance' => 0,
            'surname' => $request->surname,
            'studentId' => $request->studentId,
            'cardNumber' => $request->cardNumber,
        ]);

        // assign role
        $user_role = Role::where(['name' => 'user'])->first();
        if ($user_role) {
            $user->assignRole($user_role);
        }
        // send response
        return new UserResource($user);
    }
    // block user
    public function block(User $user)
    {
        $user->active = !$user->active;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'User blocked successfully',
        ]);
    }
    public function changePassword(User $user, Request $request)
    {
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully',
        ]);
    }
}
