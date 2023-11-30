<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Resources\UserResource;
use App\Models\item;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

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
    public function details(Request $request, Role $role)
    {
        $role->givePermissionTo('users.update');
        return new UserResource($request->user());
    }
    // block user
    public function block(User $user)
    {
        $user->update([
            'active' => !$user->active
        ]);
        return response()->json([
            'success' => true,
            'message' => 'User inactive successfully'
        ]);
    }
    // change password
    public function changePassword(Request $request, Role $role)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);
        $user = $request->user()->id;
        $update = DB::table('users')->where('id', $user)->update(['password' => bcrypt($request->password)]);

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully'
        ]);
    }
    // delete user
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}