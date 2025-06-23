<?php

namespace App\Http\Controllers;

use App\Models\ProductionSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductionScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,manager')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = ProductionSchedule::query();
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by production line
        if ($request->filled('production_line')) {
            $query->where('production_line', $request->production_line);
        }
        
        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('start_time', [$request->start_date, $request->end_date]);
        }
        
        // Order by latest
        $query->orderBy('start_time', 'desc');
        
        // Get paginated results
        $schedules = $query->paginate(10)->withQueryString();
        
        // Get unique production lines for the filter dropdown
        $productionLines = ProductionSchedule::select('production_line')
                            ->distinct()
                            ->orderBy('production_line')
                            ->pluck('production_line')
                            ->toArray();
        
        return view('production-schedules.index', compact('schedules', 'productionLines'));
    }



    public function create()
    {
        return view('production-schedules.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'production_line' => 'required|string|max:255',
            'target_quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,active,completed',
            'notes' => 'nullable|string',
        ]);
        
        $validated['created_by'] = Auth::id();
        
        $schedule = ProductionSchedule::create($validated);
        
        return redirect()->route('production-schedules.show', $schedule)
            ->with('success', 'Jadwal produksi berhasil dibuat.');
    }

    public function show(ProductionSchedule $productionSchedule)
    {
        $productionSchedule->load(['tasks', 'creator']);
        
        return view('production-schedules.show', ['schedule' => $productionSchedule]);
    }

    public function edit(ProductionSchedule $productionSchedule)
    {
        return view('production-schedules.edit', ['schedule' => $productionSchedule]);
    }

    public function update(Request $request, ProductionSchedule $productionSchedule)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'production_line' => 'required|string|max:255',
            'target_quantity' => 'required|integer|min:1',
            'completed_quantity' => 'required|integer|min:0',
            'status' => 'required|in:pending,active,completed',
            'notes' => 'nullable|string',
        ]);
        
        $productionSchedule->update($validated);
        
        return redirect()->route('production-schedules.show', $productionSchedule)
            ->with('success', 'Jadwal produksi berhasil diperbarui.');
    }

    public function destroy(ProductionSchedule $productionSchedule)
    {
        $productionSchedule->delete();
        
        return redirect()->route('production-schedules.index')
            ->with('success', 'Jadwal produksi berhasil dihapus.');
    }
}
