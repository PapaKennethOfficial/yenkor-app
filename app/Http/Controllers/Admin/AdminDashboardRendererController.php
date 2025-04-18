<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\AuditTrailService;

class AdminDashboardRendererController extends \App\Http\Controllers\Controller
{
    protected $auditTrailService;

    public function __construct(AuditTrailService $auditTrailService)
    {
        $this->auditTrailService = $auditTrailService;
    }

    //Controller that renders posted items
    public function dashboardRenderer(){
        
        // Fetch metrics from the service
        $totalClicks = $this->auditTrailService->getTotalClicks();
        $registeredUsers = $this->auditTrailService->getRegisteredUsers();
        $uniqueClicks = $this->auditTrailService->getUniqueClicks();
        $auditTrails = $this->auditTrailService->getAuditTrails();

        $userData = User::query()->orderBy('id', 'desc')->limit(100)->get();

        return view('admin.dashboard', compact('totalClicks', 'registeredUsers', 'uniqueClicks', 'auditTrails', 'userData'));

        // return view('admin.dashboard')
        //     ->with('user_data', $user_data)->with('totalClicks', $totalClicks)
        //     ->with('registeredUsers', $registeredUsers)->with('uniqueClicks', $uniqueClicks)
        //     ->with('auditTrails', $auditTrails);
    }
}
