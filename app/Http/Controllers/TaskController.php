<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Report;
use App\Models\ProductionSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,manager')->except(['index', 'show', 'updateStatus']);
    }

    public function index(Request $request)
    {
        $query = Task::query();
        
        // Filter for workers - they can only see their own tasks
        if (Auth::user()->hasRole('worker')) {
            $query->where('assigned_to', Auth::id());
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        
        // Filter by schedule
        if ($request->filled('schedule_id')) {
            $query->where('production_schedule_id', $request->schedule_id);
        }
        
        // Filter by assigned user
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }
        
        // Filter by due date
        if ($request->filled('due_date')) {
            $query->whereDate('due_date', $request->due_date);
        }
        
        // Include relationships
        $query->with(['productionSchedule', 'assignedUser']);
        
        // Order by due date
        $query->orderBy('due_date');
        
        // Get paginated results
        $tasks = $query->paginate(15)->withQueryString();
        
        // Get data for dropdowns
        $schedules = ProductionSchedule::orderBy('title')->get();
        $workers = User::whereHas('role', function($q) {
            $q->where('slug', 'worker');
        })->get();
        
        return view('tasks.index', compact('tasks', 'schedules', 'workers'));
    }


    public function create()
    {
        $schedules = ProductionSchedule::where('status', '!=', 'completed')
            ->orderBy('start_time')
            ->get();
            
        $workers = User::whereHas('role', function ($query) {
            $query->where('slug', 'worker');
        })->get();
        
        return view('tasks.create', compact('schedules', 'workers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'production_schedule_id' => 'required|exists:production_schedules,id',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,in-progress,completed',
            'due_date' => 'required|date',
            'priority' => 'required|integer|min:1|max:5',
        ]);
        
        $task = Task::create($validated);
        
        return redirect()->route('tasks.show', $task)
            ->with('success', 'Tugas berhasil dibuat.');
    }

    public function show(Task $task)
    {
        $task->load(['productionSchedule', 'assignedUser']);
        
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $schedules = ProductionSchedule::where('status', '!=', 'completed')
            ->orderBy('start_time')
            ->get();
            
        $workers = User::whereHas('role', function ($query) {
            $query->where('slug', 'worker');
        })->get();
        
        return view('tasks.edit', compact('task', 'schedules', 'workers'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'production_schedule_id' => 'required|exists:production_schedules,id',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,in-progress,completed',
            'due_date' => 'required|date',
            'priority' => 'required|integer|min:1|max:5',
        ]);
        
        $task->update($validated);
        
        return redirect()->route('tasks.show', $task)
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        
        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }
    
    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:pending,in-progress,completed',
        ]);
        
        $task->status = $request->status;
        $task->save();
        
        return redirect()->back()->with('success', 'Status tugas berhasil diperbarui.');
    }
}
