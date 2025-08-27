<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\ProductionSchedule;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Report::query();

        // Filter by type
        if ($request->filled('type')) {
            $query->where('report_type', $request->type);
        }

        // Filter by schedule
        if ($request->filled('schedule_id')) {
            $query->where('production_schedule_id', $request->schedule_id);
        }

        // Filter by creator
        if ($request->filled('created_by')) {
            $query->where('created_by', $request->created_by);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        // Include relationships
        $query->with(['creator', 'productionSchedule', 'task.assignedUser']);

        // Order by latest
        $query->orderBy('created_at', 'desc');

        // Get paginated results
        $reports = $query->paginate(10)->withQueryString();

        // Get data for dropdowns
        $schedules = ProductionSchedule::orderBy('title')->get();
        $users = User::orderBy('name')->get();

        return view('reports.index', compact('reports', 'schedules', 'users'));
    }


    public function create()
    {
        $schedules = ProductionSchedule::orderBy('start_time', 'desc')->get();
        $tasks = Task::orderBy('title')->get();

        return view('reports.create', compact('schedules', 'tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'production_schedule_id' => 'nullable|exists:production_schedules,id',
            'task_id' => 'nullable|exists:tasks,id',
            'report_type' => 'required|in:daily,incident,quality,maintenance',
        ]);

        $validated['created_by'] = Auth::id();

        $report = Report::create($validated);

        return redirect()->route('reports.show', $report)
            ->with('success', 'Laporan berhasil dibuat.');
    }

    public function show(Report $report)
    {
        $report->load(['creator', 'productionSchedule', 'task.assignedUser']);

        return view('reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        if (Auth::id() !== $report->created_by && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $schedules = ProductionSchedule::orderBy('start_time', 'desc')->get();
        $tasks = Task::orderBy('title')->get();

        return view('reports.edit', compact('report', 'schedules', 'tasks'));
    }

    public function update(Request $request, Report $report)
    {
        if (Auth::id() !== $report->created_by && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'production_schedule_id' => 'nullable|exists:production_schedules,id',
            'task_id' => 'nullable|exists:tasks,id',
            'report_type' => 'required|in:daily,incident,quality,maintenance',
        ]);

        $report->update($validated);

        return redirect()->route('reports.show', $report)
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Report $report)
    {
        if (Auth::id() !== $report->created_by && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $report->delete();

        return redirect()->route('reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

        public function export(Request $request)
    {
        $query = Report::query();

        if ($request->has('type')) {
            $query->where('report_type', $request->type);
        }

        if ($request->has('schedule_id')) {
            $query->where('production_schedule_id', $request->schedule_id);
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $reports = $query->with(['creator', 'productionSchedule'])->get();

        $pdf = \PDF::loadView('reports.export', compact('reports'));

        return $pdf->download('reports-' . now()->format('Y-m-d') . '.pdf');
    }
}
