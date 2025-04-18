<!-- resources/views/livewire/admin/dashboard-stats.blade.php -->
<div class="py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                    Total Users
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900 dark:text-gray-200">
                                        {{ number_format($totalUsers) }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Users -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                    Active Users
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900 dark:text-gray-200">
                                        {{ number_format($activeUsers) }}
                                        @if($totalUsers > 0)
                                        <span class="text-sm text-gray-500 dark:text-gray-400 ml-1">({{ round(($activeUsers / $totalUsers) * 100) }}%)</span>
                                        @endif
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Today -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                    New Today
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900 dark:text-gray-200">
                                        {{ number_format($newToday) }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                    Total Revenue
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900 dark:text-gray-200">
                                        ${{ number_format($totalRevenue) }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="mb-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">User Registration</h3>
                    <div class="inline-flex rounded-md shadow-sm">
                        <button 
                            wire:click="setChartView('daily')" 
                            class="px-4 py-2 text-sm font-medium {{ $chartView == 'daily' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-200' }} rounded-l-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-10 focus:outline-none transition-colors"
                        >
                            Daily
                        </button>
                        <button 
                            wire:click="setChartView('weekly')" 
                            class="px-4 py-2 text-sm font-medium {{ $chartView == 'weekly' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-200' }} border-t border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-10 focus:outline-none transition-colors"
                        >
                            Weekly
                        </button>
                        <button 
                            wire:click="setChartView('monthly')" 
                            class="px-4 py-2 text-sm font-medium {{ $chartView == 'monthly' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-200' }} rounded-r-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-10 focus:outline-none transition-colors"
                        >
                            Monthly
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="h-80">
                        <canvas id="registrationChart"></canvas>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button id="downloadChartBtn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition duration-150 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-1">
                            Download Chart
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity and System Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Recent Activity</h3>
                </div>
                <div class="p-6">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($recentActivity as $activity)
                            <li class="py-4 flex">
                                <div class="flex-shrink-0 mr-4">
                                    @if($activity['type'] === 'login')
                                        <div class="h-10 w-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                            </svg>
                                        </div>
                                    @elseif($activity['type'] === 'register')
                                        <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                            </svg>
                                        </div>
                                    @elseif($activity['type'] === 'update')
                                        <div class="h-10 w-10 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-600 dark:text-yellow-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                    @elseif($activity['type'] === 'content')
                                        <div class="h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $activity['user'] }} 
                                        @if($activity['type'] === 'login')
                                            signed in
                                        @elseif($activity['type'] === 'register')
                                            registered
                                        @elseif($activity['type'] === 'update')
                                            updated profile
                                        @elseif($activity['type'] === 'content')
                                            {{ $activity['description'] ?? 'updated content' }}
                                        @endif
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $activity['time'] }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4">
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                            View all activity →
                        </a>
                    </div>
                </div>
            </div>

            <!-- System & Quick Actions -->
            <div class="grid grid-cols-1 gap-8">
                <!-- Recent Users -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Recent Users</h3>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($recentUsers as $user)
                                <li class="py-3 flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white">
                                            {{ substr($user['name'], 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user['name'] }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user['email'] }}</div>
                                    </div>
                                    <div class="ml-auto text-xs text-gray-500 dark:text-gray-400">
                                        {{ $user['time'] }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-4">
                            <a href="{{ route('admin.users-list') }}" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                View all users →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">System Status</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- CPU Usage -->
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">CPU Usage</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $systemMetrics['cpu'] }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $systemMetrics['cpu'] }}%"></div>
                                </div>
                            </div>
                            
                            <!-- Memory Usage -->
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Memory Usage</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $systemMetrics['memory'] }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $systemMetrics['memory'] }}%"></div>
                                </div>
                            </div>
                            
                            <!-- Disk Usage -->
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Disk Usage</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $systemMetrics['disk'] }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-purple-600 h-2.5 rounded-full" style="width: {{ $systemMetrics['disk'] }}%"></div>
                                </div>
                            </div>
                            
                            <!-- System Uptime -->
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">System Uptime</span>
                                    <span class="px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full dark:bg-green-900 dark:text-green-200">
                                        Online
                                    </span>
                                </div>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $systemMetrics['uptime'] }}
                                </p>
                            </div>
                            
                            <!-- Cache Clear -->
                            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <button 
                                    wire:click="clearSystemCache" 
                                    class="w-full px-4 py-2 text-sm font-medium bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-800/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150"
                                >
                                    Clear System Cache
                                </button>
                            </div>
                        </div>
        </div>
    </div>
</div>
</div>
<script>
    document.addEventListener('livewire:initialized', function() {
        // Chart configuration
        const ctx = document.getElementById('registrationChart').getContext('2d');
        let chart;

        // Download chart functionality
        const downloadChartBtn = document.getElementById('downloadChartBtn');
        downloadChartBtn.addEventListener('click', () => {
            const link = document.createElement('a');
            link.download = 'user_registrations.png';
            link.href = chart.toBase64Image();
            link.click();
        });

        // Chart rendering function
        function renderChart(data) {
            // Destroy existing chart if it exists
            if (chart) {
                chart.destroy();
            }

            // Prepare chart data
            const labels = data.map(item => item.label);
            const values = data.map(item => item.count);

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'User Registrations',
                        data: values,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1,
                        fill: {
                            target: 'origin',
                            above: 'rgba(75, 192, 192, 0.2)'
                        }
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Registrations'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Time'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        // Livewire event listeners
        Livewire.on('statsUpdated', (event) => {
            const chartData = @this.get('chartData');
            renderChart(chartData);
        });

        Livewire.on('chartViewChanged', (event) => {
            const chartData = @this.get('chartData');
            renderChart(chartData);
        });

        // Initial chart render
        const initialChartData = @this.get('chartData');
        renderChart(initialChartData);
    });
</script>
