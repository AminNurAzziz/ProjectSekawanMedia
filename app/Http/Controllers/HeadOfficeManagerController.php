<?php

namespace App\Http\Controllers;

use App\Models\HeadOfficeManager;
use App\Http\Requests\StoreHeadOfficeManagerRequest;
use App\Http\Requests\UpdateHeadOfficeManagerRequest;
use App\Services\HeadOfficeManagerService;

class HeadOfficeManagerController extends Controller
{
    protected $headOfficeManagerService;

    public function __construct(HeadOfficeManagerService $headOfficeManagerService)
    {
        $this->headOfficeManagerService = $headOfficeManagerService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headOfficeManagers = $this->headOfficeManagerService->getAllHeadOfficeManagers();
        return response()->json($headOfficeManagers);
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
    public function store(StoreHeadOfficeManagerRequest $request)
    {
        $data = $request->validated();
        $headOfficeManager = $this->headOfficeManagerService->createHeadOfficeManager($data);
        return response()->json(
            [
                'message' => 'Head Office Manager created successfully',
                // 'headOfficeManager' => $headOfficeManager
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(HeadOfficeManager $headOfficeManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeadOfficeManager $headOfficeManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeadOfficeManagerRequest $request, HeadOfficeManager $headOfficeManager)
    {
        $data = $request->validated();
        $headOfficeManager = $this->headOfficeManagerService->updateHeadOfficeManager($data, $headOfficeManager->HeadManagerID);
        return response()->json(
            [
                'message' => 'Head Office Manager updated successfully',
                // 'headOfficeManager' => $headOfficeManager
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeadOfficeManager $headOfficeManager)
    {
        $this->headOfficeManagerService->deleteHeadOfficeManager($headOfficeManager->HeadManagerID);
        return response()->json(
            [
                'message' => 'Head Office Manager deleted successfully'
            ]
        );
    }
}
