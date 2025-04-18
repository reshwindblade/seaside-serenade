<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Settings extends Component
{
    public $appName;
    public $appEnv;
    public $appDebug;
    public $registrationEnabled;
    public $mailDriver;
    public $mailSettings = [
        'from_address' => '',
        'from_name' => ''
    ];
    public $activeTab = 'general';
    
    public function mount()
    {
        $this->loadSettings();
    }
    
    public function loadSettings()
    {
        // Load environment settings
        $this->appName = config('app.name');
        $this->appEnv = app()->environment();
        $this->appDebug = config('app.debug') ? 'true' : 'false';
        $this->registrationEnabled = !config('app.disable_registration');
        
        // Load mail settings
        $this->mailDriver = config('mail.default');
        $this->mailSettings['from_address'] = config('mail.from.address');
        $this->mailSettings['from_name'] = config('mail.from.name');
    }
    
    public function saveGeneralSettings()
    {
        // Validate settings
        $this->validate([
            'appName' => 'required|string|min:2',
        ]);
        
        // This is just a demo - in a real app, you'd need to update .env file
        // and use something like `php artisan config:cache` to refresh settings
        $this->dispatch('toast', message: 'General settings updated', data: ['position' => 'top-right', 'type' => 'success']);
    }
    
    public function saveUserSettings()
    {
        // In a real app, update the configuration and save to .env or database
        $this->dispatch('toast', message: 'User settings updated', data: ['position' => 'top-right', 'type' => 'success']);
    }
    
    public function saveMailSettings()
    {
        $this->validate([
            'mailSettings.from_address' => 'required|email',
            'mailSettings.from_name' => 'required|string',
        ]);
        
        // In a real app, update mail configuration 
        $this->dispatch('toast', message: 'Mail settings updated', data: ['position' => 'top-right', 'type' => 'success']);
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function testMailSettings()
    {
        // In a real app, send a test email
        // Mail::to(Auth::user()->email)->send(new TestMail());
        
        $this->dispatch('toast', message: 'Test email sent, please check your inbox', data: ['position' => 'top-right', 'type' => 'info']);
    }
    
    public function clearCache()
    {
        // In a real app, run artisan commands 
        // Artisan::call('cache:clear');
        // Artisan::call('view:clear');
        // Artisan::call('config:clear');
        
        $this->dispatch('toast', message: 'System cache cleared successfully', data: ['position' => 'top-right', 'type' => 'success']);
    }

    public function render()
    {
        return view('livewire.admin.settings', [
            'recentUsers' => $this->getRecentUsers(),
            'recentActivity' => $this->getRecentActivity()
        ]);
    }

    public function getRecentUsers()
    {
        // Get 5 most recent users
        if (env('USE_DUMMY_DATA', true)) {
            return [
                ['id' => 1, 'name' => 'Sarah Johnson', 'email' => 'sarah.j@example.com', 'time' => '5 mins ago'],
                ['id' => 2, 'name' => 'Michael Chen', 'email' => 'mchen@example.com', 'time' => '20 mins ago'],
                ['id' => 3, 'name' => 'Olivia Smith', 'email' => 'olivia.smith@example.com', 'time' => '1 hour ago'],
                ['id' => 4, 'name' => 'James Wilson', 'email' => 'jwilson@example.com', 'time' => '3 hours ago'],
                ['id' => 5, 'name' => 'Emma Garcia', 'email' => 'egarcia@example.com', 'time' => '5 hours ago'],
            ];
        }
        
        return \App\Models\User::latest()
            ->take(5)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'time' => $user->created_at->diffForHumans()
                ];
            })
            ->toArray();
    }
    
    public function getRecentActivity()
    {
        // In a real application, this would query a recent activity log
        // This is dummy data for demonstration
        return [
            ['id' => 1, 'type' => 'login', 'user' => 'Sarah Johnson', 'time' => '5 mins ago'],
            ['id' => 2, 'type' => 'register', 'user' => 'Raj Patel', 'time' => '10 mins ago'],
            ['id' => 3, 'type' => 'update', 'user' => 'Michael Chen', 'time' => '20 mins ago'],
            ['id' => 4, 'type' => 'login', 'user' => 'Emma Garcia', 'time' => '30 mins ago'],
            ['id' => 5, 'type' => 'content', 'user' => 'Admin', 'time' => '1 hour ago', 'description' => 'Updated rules page'],
        ];
    }
}