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
        return view('livewire.admin.settings');
    }
}