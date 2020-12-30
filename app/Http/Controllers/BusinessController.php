<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        return Business::all();
    }
    public function show(Business $business)
    {
        return $business;
    }
    public function store(Request $request)
    {
        $business = Business::create($request->all());
        return response()->json($business,201);
    }
    public function update(Request $request, Business $business)
    {
        $business->update($request->all());
        return response()->json($business,200);
    }
    public function delete(Request $request, Business $business)
    {
        $business->delete();
        return response()->json(null,204);
    }
}
