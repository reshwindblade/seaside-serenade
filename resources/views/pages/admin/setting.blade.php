<?php
// resources/views/pages/admin/settings.blade.php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('admin.settings');
middleware(['auth']);

?>

<x-layouts.admin>
    <x-slot name="header">
        System Settings
    </x-slot>

    @volt
    <?php
    new class extends Component
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
    };
    ?>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Settings Tabs -->
            <div class="mb-8 border-b border-gray-200 dark:border-gray-700">
                <nav class="flex space-x-8" aria-label="Settings Tabs">
                    <button 
                        wire:click="setActiveTab('general')" 
                        class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'general' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}"
                    >
                        General
                    </button>
                    <button 
                        wire:click="setActiveTab('users')" 
                        class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'users' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}"
                    >
                        User Settings
                    </button>
                    <button 
                        wire:click="setActiveTab('mail')" 
                        class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'mail' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}"
                    >
                        Mail
                    </button>
                    <button 
                        wire:click="setActiveTab('system')" 
                        class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'system' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}"
                    >
                        System
                    </button>
                </nav>
            </div>

            <!-- General Settings -->
            <div x-data="{}" x-show="$wire.activeTab === 'general'" class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-5">General Settings</h3>
                    
                    <form wire:submit="saveGeneralSettings">
                        <div class="space-y-6">
                            <div>
                                <x-ui.input 
                                    label="Application Name" 
                                    type="text" 
                                    id="appName" 
                                    wire:model="appName"
                                    helpText="The name of your application displayed in the UI and emails."
                                />
                            </div>
                            
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="appEnv" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Environment</label>
                                    <div class="mt-1">
                                        <input 
                                            type="text" 
                                            id="appEnv" 
                                            value="{{ $appEnv }}" 
                                            class="block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm cursor-not-allowed" 
                                            disabled 
                                            readonly
                                        >
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        Application environment (modify in .env file)
                                    </p>
                                </div>
                                
                                <div>
                                    <label for="appDebug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Debug Mode</label>
                                    <div class="mt-1">
                                        <input 
                                            type="text" 
                                            id="appDebug" 
                                            value="{{ $appDebug }}" 
                                            class="block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm cursor-not-allowed" 
                                            disabled 
                                            readonly
                                        >
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        Debug mode (modify in .env file)
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-end">
                                <x-ui.button type="primary" submit="true">
                                    Save General Settings
                                </x-ui.button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- User Settings -->
            <div x-data="{}" x-show="$wire.activeTab === 'users'" class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-5">User Settings</h3>
                    
                    <form wire:submit="saveUserSettings">
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input 
                                        id="registrationEnabled" 
                                        type="checkbox" 
                                        wire:model="registrationEnabled" 
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                                    >
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="registrationEnabled" class="font-medium text-gray-700 dark:text-gray-300">
                                        Enable User Registration
                                    </label>
                                    <p class="text-gray-500 dark:text-gray-400">
                                        Allow new users to register through the application.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-end">
                                <x-ui.button type="primary" submit="true">
                                    Save User Settings
                                </x-ui.button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Mail Settings -->
            <div x-data="{}" x-show="$wire.activeTab === 'mail'" class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-5">Mail Settings</h3>
                    
                    <form wire:submit="saveMailSettings">
                        <div class="space-y-6">
                            <div>
                                <label for="mailDriver" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mail Driver</label>
                                <select 
                                    id="mailDriver" 
                                    wire:model="mailDriver" 
                                    class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                >
                                    <option value="smtp">SMTP</option>
                                    <option value="sendmail">Sendmail</option>
                                    <option value="mailgun">Mailgun</option>
                                    <option value="ses">Amazon SES</option>
                                    <option value="postmark">Postmark</option>
                                    <option value="log">Log</option>
                                    <option value="array">Array</option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Select the mail driver to use for sending emails.
                                </p>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <x-ui.input 
                                        label="From Address" 
                                        type="email" 
                                        id="mailFromAddress" 
                                        wire:model="mailSettings.from_address"
                                        helpText="Email address that all outgoing emails will be sent from."
                                    />
                                </div>
                                
                                <div>
                                    <x-ui.input 
                                        label="From Name" 
                                        type="text" 
                                        id="mailFromName" 
                                        wire:model="mailSettings.from_name"
                                        helpText="Name that outgoing emails will appear to be sent from."
                                    />
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <x-ui.button 
                                    type="secondary" 
                                    wire:click.prevent="testMailSettings"
                                >
                                    Test Mail Settings
                                </x-ui.button>
                                
                                <x-ui.button type="primary" submit="true">
                                    Save Mail Settings
                                </x-ui.button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- System Settings -->
            <div x-data="{}" x-show="$wire.activeTab === 'system'" class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-5">System Maintenance</h3>
                    
                    <div class="space-y-6">
                        <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4">
                            <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Cache Management</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                Clear various system caches. This can help resolve issues after configuration changes.
                            </p>
                            <x-ui.button 
                                type="secondary" 
                                wire:click="clearCache"
                            >
                                Clear System Cache
                            </x-ui.button>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4">
                            <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Application Information</h4>
                            <div class="space-y-3">
                                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            Laravel Version:
                                        </p>
                                        <p class="text-sm text-gray-800 dark:text-gray-300">
                                            {{ app()->version() }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            PHP Version:
                                        </p>
                                        <p class="text-sm text-gray-800 dark:text-gray-300">
                                            {{ phpversion() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            Server:
                                        </p>
                                        <p class="text-sm text-gray-800 dark:text-gray-300">
                                            {{ isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : 'Unknown' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            Database:
                                        </p>
                                        <p class="text-sm text-gray-800 dark:text-gray-300">
                                            {{ config('database.connections.' . config('database.default') . '.driver', 'Unknown') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endvolt
</x-layouts.admin>