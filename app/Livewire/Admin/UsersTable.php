<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Services\ExportService;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UsersTable extends Component
{
    use WithPagination;
    
    public $search = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    
    // Export options
    public $showExportOptions = false;
    
    // Edit modal
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $selectedUserId = null;
    
    // Form data
    public $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
    ];
    
    // Validation rules
    protected $rules = [
        'form.name' => 'required|string|min:3',
        'form.email' => 'required|email',
        'form.phone' => 'required|string|min:10|max:15',
    ];

    protected $exportService;

    public function boot(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }
    
    public function updatingSearch()
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
        // Implementation for print functionality
        // This could open a print dialog or generate a printable view
        $this->dispatch('print-table');
    }
    
    protected function getUsersQuery()
    {
        return User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection);
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
            ];
            
            $this->showEditModal = true;
            $this->dispatch('open-modal', 'edit-user-modal');
        }
    }
    
    public function updateUser()
    {
        $this->validate();
        
        $user = User::find($this->selectedUserId);
        
        if ($user) {
            // Check if email is changed and it already exists for another user
            if ($user->email !== $this->form['email']) {
                $this->validate([
                    'form.email' => 'unique:users,email,' . $user->id
                ]);
            }
            
            $user->update([
                'name' => $this->form['name'],
                'email' => $this->form['email'],
                'phone' => $this->form['phone'],
            ]);
            
            $this->dispatch('toast', message: 'User updated successfully', data: ['position' => 'top-right', 'type' => 'success']);
            $this->closeModal();
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
    }
    
    public function closeModal()
    {
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->selectedUserId = null;
        $this->resetValidation();
        $this->form = [
            'name' => '',
            'email' => '',
            'phone' => '',
        ];
    }
    
    public function render()
    {
        $users = $this->getUsersQuery()->paginate($this->perPage);
        
        return view('livewire.admin.users-table', [
            'users' => $users
        ]);
    }
}