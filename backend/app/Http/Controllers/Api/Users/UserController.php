<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Resources\UserResource;
use App\Models\item;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /**
     * User Api
     * @OA\Get(
     *     path="/api/user",
     *     tags={"User"},
     *     security={
     *         {"bearerAuth": {}}
     *     },
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
    public function details(Request $request,Role $role)
    {
        $role->givePermissionTo('users.update');
        return new UserResource($request->user());
    }

}
