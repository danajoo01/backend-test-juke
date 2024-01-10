<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        $province_id = $request->get('province_id');
        if ($province_id) {
            $data = Cities::where('province_id', '=', $province_id)->get();
        } else {
            $data = Cities::all();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Load data successfully',
            'data' => $data
        ], 200);
    }
}
