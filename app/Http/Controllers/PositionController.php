<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Services\PositionService;
use Illuminate\Support\Facades\Log;

class PositionController extends Controller
{
    protected $positionService;

    public function __construct(PositionService $positionService)
    {
        parent::__construct();
        $this->positionService = $positionService;
    }

    public function index()
    {
        try {
            $positions = $this->positionService->getAllPositions();

            $this->logService->createLog('Fetched positions successfully', 'fetch');
            return view('positions.index', compact('positions'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch positions: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch positions: ' . $e->getMessage());
        }
    }

    public function store(StorePositionRequest $request)
    {
        try {
            $this->positionService->createPosition($request->validated());

            $this->logService->createLog('Position created successfully', 'store');
            return redirect('/positions')->with('success', 'Position created successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create position: ' . $e->getMessage());
            return back()->with('error', 'Failed to create position: ' . $e->getMessage());
        }
    }

    public function update(UpdatePositionRequest $request, Position $position)
    {
        try {
            $this->positionService->updatePosition($request->validated(), $position);

            $this->logService->createLog('Position updated successfully', 'update');
            return redirect('/positions')->with('success', 'Position updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update position: ' . $e->getMessage());
            return back()->with('error', 'Failed to update position: ' . $e->getMessage());
        }
    }

    public function destroy(Position $position)
    {
        try {
            $this->positionService->deletePosition($position);

            $this->logService->createLog('Position deleted successfully', 'delete');
            return redirect('/positions')->with('success', 'Position deleted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete position: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete position: ' . $e->getMessage());
        }
    }
}
