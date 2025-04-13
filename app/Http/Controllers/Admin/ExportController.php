<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ExportService;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    protected $exportService;

    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    /**
     * Export users as PDF
     */
    public function exportUsersPdf(Request $request)
    {
        $headers = [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'created_at' => 'Registered On',
        ];
        
        $users = $this->getFilteredUsers($request);
        
        return $this->exportService->exportToPdf($users, $headers, 'users-list');
    }
    
    /**
     * Export users as Excel
     */
    public function exportUsersExcel(Request $request)
    {
        $headers = [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'created_at' => 'Registered On',
        ];
        
        $users = $this->getFilteredUsers($request);
        
        return $this->exportService->exportToExcel($users, $headers, 'users-list');
    }
    
    /**
     * Export users as CSV
     */
    public function exportUsersCsv(Request $request)
    {
        $headers = [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'created_at' => 'Registered On',
        ];
        
        $users = $this->getFilteredUsers($request);
        
        return $this->exportService->exportToCsv($users, $headers, 'users-list');
    }
    
    /**
     * Get filtered users based on request parameters
     */
    protected function getFilteredUsers(Request $request)
    {
        return User::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%');
                });
            })
            ->orderBy($request->sort_field ?? 'created_at', $request->sort_direction ?? 'desc')
            ->get();
    }
}