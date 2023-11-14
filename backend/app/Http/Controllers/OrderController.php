<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Models\item;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(Request $request){
        $orders = Auth::user()->orders()->with('item')->with('user')->get();
        return Helper::sendSuccess('Orders retrieved successfully',$orders,200);
    }
    public function buy(Request $request,item $item){
        if($request->user()->balance < $item->price){
            return Helper::sendError('You don\'t have enough balance',null,400);
        }
        $request->user()->orders()->create([
            'item_id' => $item->id,
            'quantity' => 1,
            'total_price' => $item->price,
            'status' => 'pending',
        ]);
        $request->user()->balance -= $item->price;
        $request->user()->save();
        return Helper::sendSuccess('Item purchased successfully',$item,200);
    }
}
