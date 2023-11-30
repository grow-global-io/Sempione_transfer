<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Models\item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function index(Request $request)
    {
        $items = item::all();
        return Helper::sendSuccess('Items retrieved successfully', $items, 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'images' => 'required',
            'description' => 'required'
        ]);
        $item = item::create($request->all());
        return Helper::sendSuccess('Item created successfully', $item, 200);
    }

    public function update(Request $request, item $item)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'images' => 'required',
            'description' => 'required'
        ]);
        $item->update($request->all());
        return Helper::sendSuccess('Item updated successfully', $item, 200);
    }
    public function destroy(Item $item)
    {
        $item->delete();
        return Helper::sendSuccess('Item deleted successfully', null, 200);
    }
}