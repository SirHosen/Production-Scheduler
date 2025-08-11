<?php

namespace App\Http\Controllers;

use App\Models\ProductionSchedule;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        $data = [
            'total_schedules' => ProductionSchedule::count(),
            'active_schedules' => ProductionSchedule::where('status', 'active')->count(),
            'completed_schedules' => ProductionSchedule::where('status', 'completed')->count(),
            'pending_tasks' => Task::where('status', 'pending')->count(),
        ];
        
        // Data untuk worker
        if ($user->hasRole('worker')) {
            $data['my_tasks'] = Task::where('assigned_to', $user->id)
                ->where('status', '!=', 'completed')
                ->orderBy('due_date')
                ->take(5)
                ->get();
                
            $data['completed_tasks'] = Task::where('assigned_to', $user->id)
                ->where('status', 'completed')
                ->count();
        } 
        // Data untuk manager atau admin
        elseif ($user->hasRole('manager') || $user->hasRole('admin')) {
            $data['recent_schedules'] = ProductionSchedule::orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            
            $data['workers_count'] = User::whereHas('role', function ($query) {
                $query->where('slug', 'worker');
            })->count();
            
            $data['completed_tasks_month'] = Task::where('status', 'completed')
                ->whereMonth('updated_at', Carbon::now()->month)
                ->count();
        }
        
        return view('dashboard', $data);
    }
}
