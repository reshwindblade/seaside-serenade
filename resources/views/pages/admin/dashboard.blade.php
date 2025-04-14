<?php

use App\Models\User;
use App\Models\Rule;
use App\Models\Npc;
use App\Models\Character;
use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('admin.dashboard');
middleware(['auth', 'admin']);

new class extends Component
{
    public $stats = [
        'users' => 0,
        'rules' => 0,
        'npcs' => 0,
        'characters' => 0,
    ];
    
    public $recentUsers = [];
    public $recentContent = [];
    
    public function mount()
    {
        $this->loadStats();
        $this->loadRecentUsers();
        $this->loadRecentContent();
    }
    
    public function loadStats()
    {
        $this->stats = [
            'users' => User::count(),
            'rules' => Rule::count(),
            'npcs' => Npc::count(),
            'characters' => Character::count(),
        ];
    }
    
    public function loadRecentUsers()
    {
        $this->recentUsers = User::latest()->take(5)->get();
    }
    
    public function loadRecentContent()
    {
        // Combining different content types with polymorphic approach
        $rules = Rule::latest()->take(3)->get()->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'type' => 'Rule',
                'route' => route('admin.rules.edit', $item),
                'created_at' => $item->created_at,
                'is_active' => $item->is_active,
            ];
        });
        
        $npcs = Npc::latest()->take(3)->get()->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'type' => 'NPC',
                'route' => route('admin.npcs.edit', $item),
                'created_at' => $item->created_at,
                'is_active' => $item->is_active,
            ];
        });
        
        $characters = Character::latest()->take(3)->get()->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'type' => 'Character',
                'route' => route('admin.characters.edit', $item),
                'created_at' => $item->created_at,
                'is_active' => $item->is_active,
            ];
        });
        
        // Merge and sort by creation date
        $combined = $rules->concat($npcs)->concat($characters);
        $this->recentContent = $combined->sortByDesc('created_at')->take(10)->values()->all();
    }
};

?>

<x-layouts.admin>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Dashboard
        </h1>
        
        <div>
            <a href="{{ route('admin.dashboard') }}" class="admin-btn admin-btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Refresh Data
            </a>
        </div>
    </x-slot>
    
    <div class="space-y-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Users Stat -->
            <div class="admin-stat-card">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-full p-3 bg-pink-100 dark:bg-pink-900/30">
                        <svg class="h-6 w-6 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <span class="admin-stat-label">Total Users</span>
                        <span class="admin-stat-value">{{ $stats['users'] }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Rules Stat -->
            <div class="admin-stat-card">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-full p-3 bg-purple-100 dark:bg-purple-900/30">
                        <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <span class="admin-stat-label">Total Rules</span>
                        <span class="admin-stat-value">{{ $stats['rules'] }}</span>
                    </div>
                </div>
            </div>
            
            <!-- NPCs Stat -->
            <div class="admin-stat-card">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-full p-3 bg-blue-100 dark:bg-blue-900/30">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <span class="admin-stat-label">Total NPCs</span>
                        <span class="admin-stat-value">{{ $stats['npcs'] }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Characters Stat -->
            <div class="admin-stat-card">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-full p-3 bg-green-100 dark:bg-green-900/30">
                        <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <span class="admin-stat-label">Total Characters</span>
                        <span class="admin-stat-value">{{ $stats['characters'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Quick Actions Card -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Quick Actions
                    </h2>
                </div>
                <div class="admin-card-body">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-4">
                        <a href="{{ route('admin.rules.create') }}" class="flex flex-col items-center p-4 border border-pink-100 dark:border-purple-900/30 rounded-lg bg-white dark:bg-gray-800 hover:bg-pink-50 dark:hover:bg-pink-900/10 transition-colors">
                            <svg class="h-8 w-8 text-pink-600 dark:text-pink-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">New Rule</span>
                        </a>
                        <a href="{{ route('admin.npcs.create') }}" class="flex flex-col items-center p-4 border border-pink-100 dark:border-purple-900/30 rounded-lg bg-white dark:bg-gray-800 hover:bg-pink-50 dark:hover:bg-pink-900/10 transition-colors">
                            <svg class="h-8 w-8 text-pink-600 dark:text-pink-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">New NPC</span>
                        </a>
                        <a href="{{ route('admin.characters.create') }}" class="flex flex-col items-center p-4 border border-pink-100 dark:border-purple-900/30 rounded-lg bg-white dark:bg-gray-800 hover:bg-pink-50 dark:hover:bg-pink-900/10 transition-colors">
                            <svg class="h-8 w-8 text-pink-600 dark:text-pink-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">New Character</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center p-4 border border-pink-100 dark:border-purple-900/30 rounded-lg bg-white dark:bg-gray-800 hover:bg-pink-50 dark:hover:bg-pink-900/10 transition-colors">
                            <svg class="h-8 w-8 text-pink-600 dark:text-pink-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Manage Users</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Recent Content Card -->
            <div class="admin-card lg:col-span-2">
                <div class="admin-card-header">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Recently Added Content
                    </h2>
                </div>
                <div class="admin-card-body p-0">
                    <div class="overflow-hidden">
                        <ul class="divide-y divide-pink-100 dark:divide-purple-900/30">
                            @forelse($recentContent as $item)
                                <li class="py-4 px-6 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            @if($item['type'] === 'Rule')
                                                <div class="h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                                    <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                    </svg>
                                                </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $item['name'] }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                                                <span class="admin-badge {{ $item['type'] === 'Rule' ? 'admin-badge-purple' : ($item['type'] === 'NPC' ? 'admin-badge-blue' : 'admin-badge-green') }} mr-2">
                                                    {{ $item['type'] }}
                                                </span>
                                                <span>
                                                    {{ $item['created_at']->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm {{ $item['is_active'] ? 'text-green-500 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                                                {{ $item['is_active'] ? 'Active' : 'Inactive' }}
                                            </span>
                                            <a href="{{ $item['route'] }}" class="text-pink-600 dark:text-pink-400 hover:text-pink-800 dark:hover:text-pink-300">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="py-8 px-6 text-center">
                                    <p class="text-gray-500 dark:text-gray-400">No content has been added yet.</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Users Card -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Recently Registered Users
                </h2>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-pink-600 dark:text-pink-400 hover:text-pink-800 dark:hover:text-pink-300">
                    View All
                </a>
            </div>
            <div class="admin-card-body p-0">
                <ul class="divide-y divide-pink-100 dark:divide-purple-900/30">
                    @forelse($recentUsers as $user)
                        <li class="py-4 px-6 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-pink-400 to-purple-500 flex items-center justify-center text-white font-bold">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->email }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $user->created_at->diffForHumans() }}
                                </div>
                                @if($user->is_admin)
                                    <div class="admin-badge admin-badge-success">
                                        Admin
                                    </div>
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="py-8 px-6 text-center">
                            <p class="text-gray-500 dark:text-gray-400">No users have registered yet.</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-layouts.admin>