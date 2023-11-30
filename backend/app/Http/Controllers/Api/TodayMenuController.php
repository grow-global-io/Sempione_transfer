<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TodayMenu;

class TodayMenuController extends Controller
{
    // Todays menu curd operation
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => TodayMenu::all()
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'images' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $todaymenu = TodayMenu::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $todaymenu
        ]);
    }
    public function update(Request $request, TodayMenu $todaymenu)
    {
        $request->validate([
            'name' => 'required',
            'images' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $todaymenu->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $todaymenu
        ]);
    }
    public function destroy(TodayMenu $todaymenu)
    {
        $todaymenu->delete();
        return response()->json([
            'success' => true,
            'data' => $todaymenu
        ]);
    }

}
