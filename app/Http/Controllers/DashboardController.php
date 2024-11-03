<?php
namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use App\Models\Information;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $positionCount = Position::count();
        $userCount = User::count();
        $userName = User::value('name');
        $informationCount = Information::count();
        $time = now()->format('H:i:s');
        
        return view('dashboard.index', compact('title', 'positionCount', 'userCount', 'userName', 'informationCount', 'time'));
              
    }
}
