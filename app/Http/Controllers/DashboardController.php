<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class DashboardController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = Auth::user();

            // Pastikan user ada dan memiliki role
            if (!$user) {
                throw new \Exception('User not authenticated.');
            }

            // Menghitung jumlah total pengguna
            $totalUsers = User::count();


            return view('dashboard', [
                'totalUsers' => $totalUsers,
                // 'recentActivities' => $recentActivities,
            ]);
        } catch (\Exception $e) {
            // Log error (optional)
            Log::error('Dashboard error: ' . $e->getMessage());

            // Redirect ke halaman 404
            return response()->view('errors.404', [], 404);
        }
    }
}
