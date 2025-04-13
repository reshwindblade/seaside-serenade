<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('admin.dashboard');
middleware(['auth']);

new class extends Component
{
    public $totalUsers = 0;
    public $todayUsers = 0;
    public $weekUsers = 0;
    public $monthUsers = 0;
    public $dailyStats = [];
    public $weeklyStats = [];
    public $monthlyStats = [];

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        // Total users count
        $this->totalUsers = User::count();
        
        // Today's registrations
        $this->todayUsers = User::whereDate('created_at', Carbon::today())->count();
        
        // This week's registrations
        $this->weekUsers = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        
        // This month's registrations
        $this->monthUsers = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
            
        // Daily stats for the last 7 days
        $this->dailyStats = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => Carbon::parse($item->date)->format('M d'),
                    'count' => $item->count
                ];
            })
            ->toArray();
            
        // Weekly stats for the last 4 weeks
        $this->weeklyStats = User::select(DB::raw('YEARWEEK(created_at, 1) as week'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subWeeks(4))
            ->groupBy('week')
            ->orderBy('week')
            ->get()
            ->map(function ($item) {
                $weekStart = Carbon::now()->setISODate(substr($item->week, 0, 4), substr($item->week, 4));
                return [
                    'week' => 'Week ' . $weekStart->weekOfYear,
                    'count' => $item->count
                ];
            })
            ->toArray();
            
        // Monthly stats for the last 6 months
        $this->monthlyStats = User::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => Carbon::createFromDate($item->year, $item->month, 1)->format('M Y'),
                    'count' => $item->count
                ];
            })
            ->toArray();
    }
};

?>

<x-layouts.app>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    @volt('admin.dashboard')
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 gap-5 mb-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- Total Users -->
                <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                            <p class="text-3xl font-bold text-gray-700 dark:text-gray-200">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>

                <!-- Today's Registrations -->
                <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Today</p>
                            <p class="text-3xl font-bold text-gray-700 dark:text-gray-200">{{ $todayUsers }}</p>
                        </div>
                    </div>
                </div>

                <!-- This Week's Registrations -->
                <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 text-purple-500 bg-purple-100 rounded-full dark:bg-purple-900 dark:text-purple-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">This Week</p>
                            <p class="text-3xl font-bold text-gray-700 dark:text-gray-200">{{ $weekUsers }}</p>
                        </div>
                    </div>
                </div>

                <!-- This Month's Registrations -->
                <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:bg-orange-900 dark:text-orange-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">This Month</p>
                            <p class="text-3xl font-bold text-gray-700 dark:text-gray-200">{{ $monthUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                <!-- Daily Registrations -->
                <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Daily Registrations (Last 7 Days)</h3>
                    <div class="h-80">
                        <canvas id="dailyChart"></canvas>
                    </div>
                </div>

                <!-- Weekly Registrations -->
                <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Weekly Registrations (Last 4 Weeks)</h3>
                    <div class="h-80">
                        <canvas id="weeklyChart"></canvas>
                    </div>
                </div>

                <!-- Monthly Registrations -->
                <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Monthly Registrations (Last 6 Months)</h3>
                    <div class="h-80">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Daily Chart
            const dailyCtx = document.getElementById('dailyChart').getContext('2d');
            const dailyStats = @json($dailyStats);
            new Chart(dailyCtx, {
                type: 'bar',
                data: {
                    labels: dailyStats.map(item => item.date),
                    datasets: [{
                        label: 'Registrations',
                        data: dailyStats.map(item => item.count),
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Weekly Chart
            const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
            const weeklyStats = @json($weeklyStats);
            new Chart(weeklyCtx, {
                type: 'bar',
                data: {
                    labels: weeklyStats.map(item => item.week),
                    datasets: [{
                        label: 'Registrations',
                        data: weeklyStats.map(item => item.count),
                        backgroundColor: 'rgba(139, 92, 246, 0.5)',
                        borderColor: 'rgba(139, 92, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Monthly Chart
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            const monthlyStats = @json($monthlyStats);
            new Chart(monthlyCtx, {
                type: 'bar',
                data: {
                    labels: monthlyStats.map(item => item.month),
                    datasets: [{
                        label: 'Registrations',
                        data: monthlyStats.map(item => item.count),
                        backgroundColor: 'rgba(245, 158, 11, 0.5)',
                        borderColor: 'rgba(245, 158, 11, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endvolt
</x-layouts.app>