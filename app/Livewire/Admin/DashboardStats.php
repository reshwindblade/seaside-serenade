<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardStats extends Component
{
    public $totalUsers = 0;
    public $activeUsers = 0;
    public $newToday = 0;
    public $totalRevenue = 0;
    public $chartData = [];
    public $chartView = 'daily'; // Options: daily, weekly, monthly
    public $systemMetrics = [
        'cpu' => 28,
        'memory' => 65,
        'disk' => 42,
        'uptime' => '23 days, 5 hours, 17 minutes'
    ];
    
    public function mount()
    {
        $this->loadStats();
    }

    public function setChartView($view)
    {
        $this->chartView = $view;
        $this->loadStats();
        $this->dispatch('chartViewChanged');
    }

    public function loadStats()
    {
        if (env('USE_DUMMY_DATA', true)) {
            $this->loadDummyData();
        } else {
            $this->loadRealData();
        }
        
        $this->dispatch('statsUpdated');
    }

    protected function loadRealData()
    {
        // Total users count
        $this->totalUsers = User::count();
        
        // Active users (users who logged in within the last 30 days)
        $this->activeUsers = User::where('updated_at', '>=', Carbon::now()->subDays(30))->count();
        
        // Today's new users
        $this->newToday = User::whereDate('created_at', Carbon::today())->count();
        
        // In a real application, you would calculate actual revenue
        // This is a placeholder - replace with actual revenue logic
        $this->totalRevenue = 0;
            
        // Chart data based on selected view
        switch ($this->chartView) {
            case 'weekly':
                $this->loadWeeklyData();
                break;
            case 'monthly':
                $this->loadMonthlyData();
                break;
            case 'daily':
            default:
                $this->loadDailyData();
                break;
        }
    }

    protected function loadDailyData()
    {
        // Get registration data for the last 14 days
        $this->chartData = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
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

    protected function loadWeeklyData()
    {
        // Get registration data for the last 12 weeks
        $this->chartData = [];
        $startDate = Carbon::now()->subWeeks(11)->startOfWeek();
        
        for ($i = 0; $i < 12; $i++) {
            $weekStart = $startDate->copy()->addWeeks($i);
            $weekEnd = $weekStart->copy()->endOfWeek();
            
            $count = User::whereBetween('created_at', [$weekStart, $weekEnd])->count();
            
            $this->chartData[] = [
                'date' => $weekStart->format('Y-m-d'),
                'count' => $count,
                'label' => 'Week ' . $weekStart->weekOfYear
            ];
        }
    }

    protected function loadMonthlyData()
    {
        // Get registration data for the last 12 months
        $this->chartData = User::select(
                DB::raw('YEAR(created_at) as year'), 
                DB::raw('MONTH(created_at) as month'), 
                DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $date = Carbon::createFromDate($item->year, $item->month, 1);
                return [
                    'date' => $date->format('Y-m-d'),
                    'count' => $item->count,
                    'label' => $date->format('M Y')
                ];
            })
            ->toArray();
    }

    protected function loadDummyData()
    {
        $this->totalUsers = 412;
        $this->activeUsers = 260;
        $this->newToday = 37;
        $this->totalRevenue = 1626;
        
        // Generate dummy chart data based on selected view
        switch ($this->chartView) {
            case 'weekly':
                $this->generateDummyWeeklyData();
                break;
            case 'monthly':
                $this->generateDummyMonthlyData();
                break;
            case 'daily':
            default:
                $this->generateDummyDailyData();
                break;
        }
    }

    protected function generateDummyDailyData()
    {
        // Generate dummy data for the last 14 days
        $startDate = Carbon::now()->subDays(13);
        $this->chartData = [];
        
        for ($i = 0; $i < 14; $i++) {
            $date = $startDate->copy()->addDays($i);
            $count = rand(10, 50); // Random data for most days
            
            // Create a pattern with some outliers
            if ($i == 2) $count = 85;
            else if ($i == 3) $count = 78;
            else if ($i == 4) $count = 22;
            else if ($i == 7) $count = 29;
            else if ($i == 9) $count = 62;
            else if ($i == 12) $count = 37;
            
            $this->chartData[] = [
                'date' => $date->format('Y-m-d'),
                'count' => $count,
                'label' => $date->format('M d')
            ];
        }
    }

    protected function generateDummyWeeklyData()
    {
        // Generate dummy weekly data
        $startWeek = Carbon::now()->subWeeks(11);
        $this->chartData = [];
        
        for ($i = 0; $i < 12; $i++) {
            $date = $startWeek->copy()->addWeeks($i);
            $count = rand(70, 320); // Random data for weeks
            
            // Create some pattern
            if ($i == 3) $count = 380;
            else if ($i == 7) $count = 420;
            else if ($i == 10) $count = 210;
            
            $this->chartData[] = [
                'date' => $date->format('Y-m-d'),
                'count' => $count,
                'label' => 'Week ' . $date->weekOfYear
            ];
        }
    }

    protected function generateDummyMonthlyData()
    {
        // Generate dummy monthly data
        $startMonth = Carbon::now()->subMonths(11);
        $this->chartData = [];
        
        for ($i = 0; $i < 12; $i++) {
            $date = $startMonth->copy()->addMonths($i);
            $count = rand(300, 1200); // Random data for months
            
            // Create some pattern
            if ($i == 2) $count = 1800;
            else if ($i == 5) $count = 2200;
            else if ($i == 8) $count = 1500;
            
            $this->chartData[] = [
                'date' => $date->format('Y-m-d'),
                'count' => $count,
                'label' => $date->format('M Y')
            ];
        }
    }

    public function clearSystemCache()
    {
        // In a real application, this would call relevant cache clearing commands
        // For example: Artisan::call('cache:clear');
        
        $this->dispatch('toast', message: 'System cache cleared successfully', data: ['position' => 'top-right', 'type' => 'success']);
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
        
        return User::latest()
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

    public function render()
    {
        return view('livewire.admin.dashboard-stats', [
            'recentUsers' => $this->getRecentUsers(),
            'recentActivity' => $this->getRecentActivity()
        ]);
    }
}