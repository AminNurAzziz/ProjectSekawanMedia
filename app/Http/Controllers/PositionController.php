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
        $this->positionService = $positionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = $this->positionService->getAllPositions();
        return view('positions.index', compact('positions'));
        // return response()->json($positions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePositionRequest $request)
    {
        $this->positionService->createPosition($request->validated());
        return redirect('/positions')->with('success', 'Position created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {

        Log::info('Position updated successfully' . $position);
        $this->positionService->updatePosition($request->validated(), $position);
        return redirect('/positions')->with('success', 'Position updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $this->positionService->deletePosition($position);
        return redirect('/positions')->with('success', 'Position deleted successfully');
    }
}
