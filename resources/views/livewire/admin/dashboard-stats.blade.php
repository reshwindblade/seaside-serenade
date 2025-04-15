<div class="py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700 transition-all hover:shadow-lg">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Users</h3>
                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $totalUsers }}</p>
                <div class="mt-4 flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="text-green-500">5.5%</span>
                    <span class="text-gray-500 dark:text-gray-400 ml-1">vs last month</span>
                </div>
            </div>

            <!-- Active Users -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700 transition-all hover:shadow-lg">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Active Users</h3>
                <p class="text-3xl font-bold text-blue-500">{{ $activeUsers }}</p>
                <div class="mt-4 flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="text-green-500">3.2%</span>
                    <span class="text-gray-500 dark:text-gray-400 ml-1">vs last month</span>
                </div>
            </div>

            <!-- New Today -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700 transition-all hover:shadow-lg">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">New Today</h3>
                <p class="text-3xl font-bold text-cyan-500">{{ $newToday }}</p>
                <div class="mt-4 flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path>
                    </svg>
                    <span class="text-red-500">1.5%</span>
                    <span class="text-gray-500 dark:text-gray-400 ml-1">vs yesterday</span>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700 transition-all hover:shadow-lg">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Revenue</h3>
                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">${{ $totalRevenue }}</p>
                <div class="mt-4 flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="text-green-500">8.3%</span>
                    <span class="text-gray-500 dark:text-gray-400 ml-1">vs last month</span>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">User Registration</h2>
                <div class="inline-flex rounded-lg shadow-sm">
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

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Users -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Recent Users</h3>
                </div>
                <div class="p-6">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach(range(1, 5) as $i)
                            <li class="py-3 flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white">
                                        {{ chr(64 + $i) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">User {{ $i }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">user{{ $i }}@example.com</div>
                                </div>
                                <div class="ml-auto text-xs text-gray-500 dark:text-gray-400">
                                    {{ Carbon\Carbon::now()->subMinutes(rand(15, 120))->diffForHumans() }}
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
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">System Status</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- CPU Usage -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">CPU Usage</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">28%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 28%"></div>
                            </div>
                        </div>
                        
                        <!-- Memory Usage -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Memory Usage</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">65%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div class="bg-green-600 h-2.5 rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                        
                        <!-- Disk Usage -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Disk Usage</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">42%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div class="bg-purple-600 h-2.5 rounded-full" style="width: 42%"></div>
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
                                {{ rand(20, 60) }} days, {{ rand(1, 23) }} hours, {{ rand(1, 59) }} minutes
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script>
        let registrationChart;
        
        function initializeChart() {
            const ctx = document.getElementById('registrationChart')?.getContext('2d');
            if (!ctx) return;
            
            // If there's an existing chart, destroy it
            if (registrationChart) {
                registrationChart.destroy();
            }
            
            const chartData = @js($chartData);
            
            // Format data for the chart
            const labels = chartData.map(item => item.label);
            const data = chartData.map(item => item.count);
            
            // Set chart type based on current view
            const chartType = '{{ $chartView }}' === 'monthly' ? 'bar' : 'line';
            
            // Create the chart
            registrationChart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: labels,
                    datasets: [{
                        label: '{{ ucfirst($chartView) }} Registrations',
                        data: data,
                        backgroundColor: 'rgba(59, 130, 246, 0.6)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        borderRadius: 4,
                        barThickness: '{{ $chartView }}' === 'monthly' ? 20 : undefined,
                        fill: '{{ $chartView }}' === 'daily'
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
                                },
                                maxRotation: 45,
                                minRotation: '{{ $chartView }}' === 'monthly' ? 45 : 0
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
</div>