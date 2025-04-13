{{-- resources/views/pages/admin/dashboard.blade.php --}}
<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('admin.dashboard');
middleware(['auth']);

?>

<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Admin Dashboard') }}
            </h2>
            @if(env('APP_ENV') === 'local')
                <div class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800 dark:bg-amber-800 dark:text-amber-100">
                    Using {{ env('USE_DUMMY_DATA', false) ? 'Dummy' : 'Real' }} Data
                </div>
            @endif
        </div>
    </x-slot>

    @volt
    <?php
    new class extends Component
    {
        public $totalUsers = 0;
        public $activeUsers = 0;
        public $newToday = 0;
        public $totalRevenue = 0;
        public $dailyStats = [];
        public $chartView = 'daily'; // Options: daily, time, day
        
        public function mount()
        {
            $this->loadStats();
        }

        public function setChartView($view)
        {
            $this->chartView = $view;
            $this->dispatch('chartViewChanged');
        }

        public function loadStats()
        {
            if (env('USE_DUMMY_DATA', false)) {
                $this->loadDummyData();
            } else {
                $this->loadRealData();
            }
            
            $this->dispatch('statsUpdated');
        }

        public function loadRealData()
        {
            // Total users count
            $this->totalUsers = User::count();
            
            // Active users (users who logged in within the last 30 days)
            $this->activeUsers = User::where('updated_at', '>=', Carbon::now()->subDays(30))->count();
            
            // Today's new users
            $this->newToday = User::whereDate('created_at', Carbon::today())->count();
            
            // Total revenue (example - would need proper implementation)
            $this->totalRevenue = 0; // Replace with actual revenue calculation
                
            // Daily stats for the last 14 days
            $this->dailyStats = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->where('created_at', '>=', Carbon::now()->subDays(14))
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->map(function ($item) {
                    return [
                        'date' => Carbon::parse($item->date)->format('Y-m-d'),
                        'count' => $item->count,
                        'label' => Carbon::parse($item->date)->format('M d')
                    ];
                })
                ->toArray();
        }

        public function loadDummyData()
        {
            $this->totalUsers = 412;
            $this->activeUsers = 260;
            $this->newToday = 201;
            $this->totalRevenue = 1626;
            
            // Generate dummy data for the last 14 days
            $startDate = Carbon::now()->subDays(13);
            $this->dailyStats = [];
            
            for ($i = 0; $i < 14; $i++) {
                $date = $startDate->copy()->addDays($i);
                $count = rand(10, 50); // Random data for most days
                
                // Create a pattern with some outliers
                if ($i == 2) $count = 190;
                else if ($i == 3) $count = 189;
                else if ($i == 4) $count = 4;
                else if ($i == 7) $count = 29;
                else if ($i == 9) $count = 80;
                
                $this->dailyStats[] = [
                    'date' => $date->format('Y-m-d'),
                    'count' => $count,
                    'label' => $date->format('M d')
                ];
            }
        }
    };
    ?>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Users -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700 transition-all hover:shadow-lg">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Users</h3>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $totalUsers }}</p>
                </div>

                <!-- Active Users -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700 transition-all hover:shadow-lg">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Active Users</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $activeUsers }}</p>
                </div>

                <!-- New Today -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700 transition-all hover:shadow-lg">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">New Today</h3>
                    <p class="text-3xl font-bold text-cyan-500">{{ $newToday }}</p>
                </div>

                <!-- Total Revenue -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700 transition-all hover:shadow-lg">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Revenue</h3>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">${{ $totalRevenue }}</p>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Registration</h2>
                    <div class="inline-flex rounded-lg shadow-sm">
                        <button 
                            wire:click="setChartView('daily')" 
                            class="px-4 py-2 text-sm font-medium {{ $chartView == 'daily' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-200' }} rounded-l-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-10 focus:outline-none transition-colors"
                        >
                            Daily
                        </button>
                        <button 
                            wire:click="setChartView('time')" 
                            class="px-4 py-2 text-sm font-medium {{ $chartView == 'time' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-200' }} border-t border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-10 focus:outline-none transition-colors"
                        >
                            Time of Day
                        </button>
                        <button 
                            wire:click="setChartView('day')" 
                            class="px-4 py-2 text-sm font-medium {{ $chartView == 'day' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-200' }} rounded-r-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-10 focus:outline-none transition-colors"
                        >
                            Day of Week
                        </button>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700">
                    <div class="h-80">
                        <canvas id="registrationChart"></canvas>
                    </div>
                    <div class="flex justify-start mt-4">
                        <button id="downloadChartBtn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition duration-150 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-1">
                            Download Chart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let registrationChart;
        
        function initializeChart() {
            const ctx = document.getElementById('registrationChart')?.getContext('2d');
            if (!ctx) return;
            
            // If there's an existing chart, destroy it
            if (registrationChart) {
                registrationChart.destroy();
            }
            
            const dailyStats = @js($dailyStats);
            
            // Format data for the chart
            const labels = dailyStats.map(item => item.label || new Date(item.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }));
            const data = dailyStats.map(item => item.count);
            
            // Create the chart
            registrationChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Daily Registration',
                        data: data,
                        backgroundColor: 'rgba(59, 130, 246, 0.6)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                        barThickness: 20,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(200, 200, 200, 0.15)'
                            },
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 11
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                boxWidth: 15,
                                usePointStyle: true,
                                pointStyle: 'rect'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                size: 12
                            },
                            bodyFont: {
                                size: 13
                            },
                            padding: 10,
                            cornerRadius: 4,
                            callbacks: {
                                label: function(context) {
                                    return 'Users: ' + context.raw;
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });
            
            // Set up download button
            document.getElementById('downloadChartBtn')?.addEventListener('click', function() {
                // Create a temporary link element
                const link = document.createElement('a');
                link.download = 'registration-chart.png';
                link.href = document.getElementById('registrationChart').toDataURL('image/png', 1.0);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', initializeChart);
        
        // Initialize when Livewire updates
        document.addEventListener('livewire:initialized', function() {
            window.Livewire.on('statsUpdated', initializeChart);
            window.Livewire.on('chartViewChanged', initializeChart);
        });
        
        // Re-initialize when the window resizes
        window.addEventListener('resize', function() {
            if (registrationChart) {
                registrationChart.resize();
            }
        });
    </script>
    @endvolt
</x-layouts.app>