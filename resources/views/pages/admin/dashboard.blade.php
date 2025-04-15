<?php
// resources/views/pages/admin/dashboard.blade.php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('admin.dashboard');
middleware(['auth']);

?>

<x-layouts.admin>
    <x-slot name="header">
        Dashboard
    </x-slot>

    @volt
    <?php
    new class extends Component
    {
        public $totalUsers = 0;
        public $activeUsers = 0;
        public $newUsersToday = 0;
        public $socialLoginUsers = 0;
        public $weeklyStats = [];
        public $userActivity = [];
        public $recentUsers = [];
        public $chartView = 'daily';
        
        public function mount()
        {
            $this->loadDashboardData();
        }

        public function loadDashboardData()
        {
            // Basic stats
            $this->totalUsers = User::count();
            $this->activeUsers = User::where('updated_at', '>=', Carbon::now()->subDays(30))->count();
            $this->newUsersToday = User::whereDate('created_at', Carbon::today())->count();
            $this->socialLoginUsers = User::whereNotNull('provider')->count();
            
            // Weekly registrations
            $startDate = Carbon::now()->subDays(6);
            $endDate = Carbon::now();
            
            $dailyRegistrations = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->where('created_at', '>=', $startDate)
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->keyBy('date');
            
            $this->weeklyStats = [];
            for ($date = $startDate; $date <= $endDate; $date = $date->copy()->addDay()) {
                $formattedDate = $date->format('Y-m-d');
                $this->weeklyStats[] = [
                    'date' => $formattedDate,
                    'label' => $date->format('D'),
                    'count' => $dailyRegistrations->has($formattedDate) ? $dailyRegistrations[$formattedDate]->count : 0
                ];
            }
            
            // Recent users
            $this->recentUsers = User::latest('created_at')
                ->take(5)
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'created_at' => $user->created_at->diffForHumans(),
                        'provider' => $user->provider,
                        'avatar' => "https://ui-avatars.com/api/?name=" . urlencode($user->name) . "&background=0D8ABC&color=fff"
                    ];
                });
            
            // User activity by hour
            $hourlyActivity = User::select(DB::raw('HOUR(created_at) as hour'), DB::raw('count(*) as count'))
                ->where('created_at', '>=', Carbon::now()->subDays(30))
                ->groupBy('hour')
                ->orderBy('hour')
                ->get()
                ->keyBy('hour');
            
            $this->userActivity = [];
            for ($hour = 0; $hour < 24; $hour++) {
                $this->userActivity[] = [
                    'hour' => $hour,
                    'label' => sprintf('%02d:00', $hour),
                    'count' => $hourlyActivity->has($hour) ? $hourlyActivity[$hour]->count : 0
                ];
            }
        }

        public function setChartView($view)
        {
            $this->chartView = $view;
            $this->dispatch('chartViewChanged');
        }

        public function refreshData()
        {
            $this->loadDashboardData();
            $this->dispatch('statsUpdated');
            $this->dispatch('toast', message: 'Dashboard data refreshed', data: ['position' => 'top-right', 'type' => 'success']);
        }
    };
    ?>

    <div class="py-6">
        <!-- Header with stats and refresh button -->
        <div class="flex flex-wrap items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Overview</h2>
            <button 
                wire:click="refreshData" 
                class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150 flex items-center"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Refresh Data
            </button>
        </div>

        <!-- Stats Cards Row -->
        <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Users Card -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                        <p class="text-3xl font-bold text-gray-700 dark:text-gray-200">{{ number_format($totalUsers) }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Users Card -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Active Users</p>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ number_format($activeUsers) }}</p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Last 30 days</p>
                    </div>
                </div>
            </div>

            <!-- New Users Today Card -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 mr-4 text-purple-500 bg-purple-100 rounded-full dark:bg-purple-900/30 dark:text-purple-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">New Today</p>
                        <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ number_format($newUsersToday) }}</p>
                    </div>
                </div>
            </div>

            <!-- Social Login Users Card -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:bg-orange-900/30 dark:text-orange-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Social Logins</p>
                        <p class="text-3xl font-bold text-orange-600 dark:text-orange-400">{{ number_format($socialLoginUsers) }}</p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $socialLoginUsers > 0 ? round(($socialLoginUsers / $totalUsers) * 100) . '%' : '0%' }} of total</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-2">
            <!-- Weekly Registration Chart -->
            <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Weekly Registrations</h3>
                    <div class="inline-flex rounded-md shadow-sm">
                        <button 
                            wire:click="setChartView('daily')" 
                            class="px-3 py-1.5 text-xs font-medium {{ $chartView == 'daily' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-300' }} rounded-l-md border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-10 focus:outline-none transition-colors"
                        >
                            Daily
                        </button>
                        <button 
                            wire:click="setChartView('time')" 
                            class="px-3 py-1.5 text-xs font-medium {{ $chartView == 'time' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-300' }} border-t border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-10 focus:outline-none transition-colors"
                        >
                            Time of Day
                        </button>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="weeklyRegistrationChart"></canvas>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Recent Users</h3>
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Joined</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Source</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($recentUsers as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{ $user['avatar'] }}" alt="{{ $user['name'] }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user['name'] }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user['email'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user['created_at'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user['provider'])
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ ucfirst($user['provider']) }}
                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                        Email
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No recent users
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('admin.users-list') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                        View all users →
                    </a>
                </div>
            </div>