<?php

namespace App\Http\Controllers;

use App\Models\BankAccounts;
use Illuminate\Http\Request;

class BankAccountsController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data successfully',
            'data' => BankAccounts::all()
        ], 200);
    }
}
