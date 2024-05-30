<?php

namespace App\Http\Controllers;

use App\Models\HeadOfficeManager;
use App\Http\Requests\StoreHeadOfficeManagerRequest;
use App\Http\Requests\UpdateHeadOfficeManagerRequest;
use App\Services\HeadOfficeManagerService;
use Illuminate\Support\Facades\Log;

class HeadOfficeManagerController extends Controller
{
    protected $headOfficeManagerService;

    public function __construct(HeadOfficeManagerService $headOfficeManagerService)
    {
        parent::__construct();
        $this->headOfficeManagerService = $headOfficeManagerService;
    }

    public function index()
    {
        try {
            $headOfficeManagers = $this->headOfficeManagerService->getAllHeadOfficeManagers();

            Log::info('Fetched head office managers successfully');
            return view('head-office-managers.index', compact('headOfficeManagers'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch head office managers: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch head office managers: ' . $e->getMessage());
        }
    }

    public function store(StoreHeadOfficeManagerRequest $request)
    {
        $data = $request->validated();
        try {
            $this->headOfficeManagerService->createHeadOfficeManager($data);

            $this->logService->createLog('Head Office Manager created successfully', 'store');
            return redirect('/head-office-managers')->with('success', 'Head Office Manager created successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create head office manager: ' . $e->getMessage());
            return back()->with('error', 'Failed to create head office manager: ' . $e->getMessage());
        }
    }

    public function update(UpdateHeadOfficeManagerRequest $request, HeadOfficeManager $headOfficeManager)
    {
        $data = $request->validated();
        try {
            $this->headOfficeManagerService->updateHeadOfficeManager($data, $headOfficeManager->HeadManagerID);

            $this->logService->createLog('Head Office Manager updated successfully', 'update');
            return redirect('/head-office-managers')->with('success', 'Head Office Manager updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update head office manager: ' . $e->getMessage());
            return back()->with('error', 'Failed to update head office manager: ' . $e->getMessage());
        }
    }

    public function destroy(HeadOfficeManager $headOfficeManager)
    {
        try {
            $this->headOfficeManagerService->deleteHeadOfficeManager($headOfficeManager->HeadManagerID);

            $this->logService->createLog('Head Office Manager deleted successfully', 'delete');
            return redirect('/head-office-managers')->with('success', 'Head Office Manager deleted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete head office manager: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete head office manager: ' . $e->getMessage());
        }
    }
}
