<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at)as month_name")) 
                    ->whereYear('created_at', date('Y')) 
                    ->groupBy(DB::raw("Month(created_at)")) 
                    ->pluck('count', 'month_name');

        $labels = $users->keys();
        $data = $users->values();
        return view('home', compact('labels', 'data'));
    }
}
