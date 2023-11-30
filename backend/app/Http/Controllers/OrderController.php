<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Models\item;
use App\Models\todayMenu;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        $orders = Auth::user()->orders()->with('item')->with('user')->get();
        return Helper::sendSuccess('Orders retrieved successfully', $orders, 200);
    }
    public function buy(Request $request, todayMenu $todayMenu)
    {
        if ($request->user()->balance < $todayMenu->price) {
            return Helper::sendError('You don\'t have enough balance', null, 400);
        }
        $request->user()->orders()->create([
            'item_id' => $todayMenu->id,
            'quantity' => $request->quantity,
            'total_price' => $todayMenu->price,
            'orderType' => $request->orderType,
            'status' => 'pending',
        ]);
        $request->user()->balance -= $todayMenu->price;
        $request->user()->save();
        return Helper::sendSuccess('Item purchased successfully', $todayMenu, 200);
    }
}
