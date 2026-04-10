<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $stats = [
            'total' => $user->todos()->count(),
            'completed' => $user->todos()->where('is_completed', true)->count(),
            'pending' => $user->todos()->where('is_completed', false)->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
