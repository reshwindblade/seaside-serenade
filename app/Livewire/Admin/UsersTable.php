<?php
// app/Livewire/Admin/UsersTable.php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Services\ExportService;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UsersTable extends Component
{
    use WithPagination;
    
    // Search & Filtering
    public $search = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $filterProvider = '';
    public $filterVerified = '';
    public $dateRange = '';
    
    // Export options
    public $showExportOptions = false;
    
    // Edit & Delete modals
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $showCreateModal = false;
    public $selectedUserId = null;
    
    // Form data
    public $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'password' => '',
        'password_confirmation' => '',
    ];
    
    // User password reset
    public $showResetPasswordModal = false;

    // Bulk actions
    public $selectedUsers = [];
    public $selectAll = false;
    public $bulkAction = '';
    
    // Filter display
    public $showFilters = false;
    
    // Statistics
    public $totalUsers = 0;
    public $filteredUsers = 0;
    public $verifiedUsers = 0;
    public $socialUsers = 0;
    
    // Validation rules
    protected $rules = [
        'form.name' => 'required|string|min:3',
        'form.email' => 'required|email',
        'form.phone' => 'nullable|string|min:10|max:15',
    ];
    
    // Create user rules
    protected $createRules = [
        'form.name' => 'required|string|min:3',
        'form.email' => 'required|email|unique:users,email',
        'form.phone' => 'nullable|string|min:10|max:15',
        'form.password' => 'required|min:8|confirmed',
        'form.password_confirmation' => 'required',
    ];

    protected $exportService;

    public function boot(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }
    
    public function mount()
    {
        $this->loadStats();
    }
    
    public function loadStats()
    {
        $this->totalUsers = User::count();
        $this->verifiedUsers = User::whereNotNull('email_verified_at')->count();
        $this->socialUsers = User::whereNotNull('provider')->count();
        $this->filteredUsers = $this->totalUsers;
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingFilterProvider()
    {
        $this->resetPage();
    }
    
    public function updatingFilterVerified()
    {
        $this->resetPage();
    }
    
    public function updatingDateRange()
    {
        $this->resetPage();
    }
    
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    public function toggleExportOptions()
    {
        $this->showExportOptions = !$this->showExportOptions;
    }
    
    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }
    
    public function resetFilters()
    {
        $this->search = '';
        $this->filterProvider = '';
        $this->filterVerified = '';
        $this->dateRange = '';
        $this->resetPage();
    }
    
    public function closeExportOptions()
    {
        $this->showExportOptions = false;
    }

    public function exportPDF()
    {
        $users = $this->getUsersQuery()->get();
        
        $headers = [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'created_at' => 'Registered On',
        ];
        
        return $this->exportService->exportToPdf($users, $headers, 'users-list');
    }

    public function exportExcel()
    {
        $users = $this->getUsersQuery()->get();
        
        $headers = [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'created_at' => 'Registered On',
        ];
        
        return $this->exportService->exportToExcel($users, $headers, 'users-list');
    }

    public function exportCSV()
    {
        $users = $this->getUsersQuery()->get();
        
        $headers = [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'created_at' => 'Registered On',
        ];
        
        return $this->exportService->exportToCsv($users, $headers, 'users-list');
    }

    public function print()
    {
        $this->dispatch('print-table');
    }
    
    protected function getUsersQuery()
    {
        $query = User::query();
        
        // Apply search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('phone', 'like', '%' . $this->search . '%');
            });
        }
        
        // Filter by social login provider
        if ($this->filterProvider) {
            if ($this->filterProvider === 'email') {
                $query->whereNull('provider');
            } else {
                $query->where('provider', $this->filterProvider);
            }
        }
        
        // Filter by verification status
        if ($this->filterVerified !== '') {
            if ($this->filterVerified === '1') {
                $query->whereNotNull('email_verified_at');
            } else {
                $query->whereNull('email_verified_at');
            }
        }
        
        // Filter by date range
        if ($this->dateRange) {
            list($start, $end) = explode(' to ', $this->dateRange);
            $query->whereBetween('created_at', [$start, $end]);
        }
        
        // Apply sorting
        $query->orderBy($this->sortField, $this->sortDirection);
        
        // Update filtered count
        $this->filteredUsers = $query->count();
        
        return $query;
    }
    
    public function openCreateModal()
    {
        $this->resetValidation();
        $this->showCreateModal = true;
        $this->form = [
            'name' => '',
            'email' => '',
            'phone' => '',
            'password' => '',
            'password_confirmation' => '',
        ];
        
        $this->dispatch('open-modal', 'create-user-modal');
    }
    
    public function createUser()
    {
        $this->validate($this->createRules);
        
        $user = User::create([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'phone' => $this->form['phone'],
            'password' => Hash::make($this->form['password']),
        ]);
        
        $this->dispatch('toast', message: 'User created successfully', data: ['position' => 'top-right', 'type' => 'success']);
        $this->closeModal();
    }
    
    public function editUser($userId)
    {
        $this->selectedUserId = $userId;
        $user = User::find($userId);
        
        if ($user) {
            $this->form = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '',
                'password' => '',
                'password_confirmation' => '',
            ];
            
            $this->showEditModal = true;
            $this->dispatch('open-modal', 'edit-user-modal');
        }
    }
    
    public function updateUser()
    {
        $this->validate([
            'form.name' => 'required|string|min:3',
            'form.email' => 'required|email|unique:users,email,' . $this->selectedUserId,
            'form.phone' => 'nullable|string|min:10|max:15',
        ]);
        
        $user = User::find($this->selectedUserId);
        
        if ($user) {
            $user->update([
                'name' => $this->form['name'],
                'email' => $this->form['email'],
                'phone' => $this->form['phone'],
            ]);
            
            $this->dispatch('toast', message: 'User updated successfully', data: ['position' => 'top-right', 'type' => 'success']);
            $this->closeModal();
        }
    }
    
    public function confirmResetPassword($userId)
    {
        $this->selectedUserId = $userId;
        $this->form['password'] = '';
        $this->form['password_confirmation'] = '';
        $this->showResetPasswordModal = true;
        $this->dispatch('open-modal', 'reset-password-modal');
    }
    
    public function resetPassword()
    {
        $this->validate([
            'form.password' => 'required|min:8|confirmed',
            'form.password_confirmation' => 'required',
        ]);
        
        $user = User::find($this->selectedUserId);
        
        if ($user) {
            $user->update([
                'password' => Hash::make($this->form['password']),
            ]);
            
            $this->dispatch('toast', message: 'Password reset successfully', data: ['position' => 'top-right', 'type' => 'success']);
            $this->closeModal();
        }
    }
    
    public function confirmVerifyEmail($userId)
    {
        $user = User::find($userId);
        
        if ($user && !$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            $this->dispatch('toast', message: 'Email verified successfully', data: ['position' => 'top-right', 'type' => 'success']);
        }
    }
    
    public function confirmDelete($userId)
    {
        $this->selectedUserId = $userId;
        $this->showDeleteModal = true;
        $this->dispatch('open-modal', 'delete-user-modal');
    }
    
    public function deleteUser()
    {
        $user = User::find($this->selectedUserId);
        
        if ($user) {
            $user->delete();
            $this->dispatch('toast', message: 'User deleted successfully', data: ['position' => 'top-right', 'type' => 'success']);
        }
        
        $this->closeModal();
        $this->loadStats();
    }
    
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUsers = $this->getUsersQuery()->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }
    
    public function executeBulkAction()
    {
        if (empty($this->selectedUsers)) {
            $this->dispatch('toast', message: 'No users selected', data: ['position' => 'top-right', 'type' => 'warning']);
            return;
        }
        
        switch ($this->bulkAction) {
            case 'verify':
                User::whereIn('id', $this->selectedUsers)
                    ->whereNull('email_verified_at')
                    ->update(['email_verified_at' => now()]);
                $this->dispatch('toast', message: 'Selected users emails verified', data: ['position' => 'top-right', 'type' => 'success']);
                break;
                
            case 'delete':
                User::whereIn('id', $this->selectedUsers)->delete();
                $this->dispatch('toast', message: 'Selected users deleted', data: ['position' => 'top-right', 'type' => 'success']);
                break;
                
            default:
                $this->dispatch('toast', message: 'Select an action', data: ['position' => 'top-right', 'type' => 'warning']);
        }
        
        $this->selectedUsers = [];
        $this->selectAll = false;
        $this->bulkAction = '';
        $this->loadStats();
    }
    
    public function closeModal()
    {
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->showCreateModal = false;
        $this->showResetPasswordModal = false;
        $this->selectedUserId = null;
        $this->resetValidation();
    }
    
    public function render()
    {
        $users = $this->getUsersQuery()->paginate($this->perPage);
        
        return view('livewire.admin.users-table', [
            'users' => $users,
            'providers' => User::whereNotNull('provider')->distinct()->pluck('provider')->toArray(),
        ]);
    }
}