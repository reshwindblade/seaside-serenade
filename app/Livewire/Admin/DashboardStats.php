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
    public $dailyStats = [];
    public $weeklyStats = [];
    public $monthlyStats = [];
    public $chartView = 'daily'; // Options: daily, weekly, monthly
    
    public function mount()
    {
        $this->loadStats();
    }

    public function setChartView($view)
    {
        $this->chartView = $view;
        $this->dispatch('chartViewChanged', ['view' => $view]);
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

    protected function loadRealData()
    {
        // Total users count
        $this->totalUsers = User::count();
        
        // Active users (users who logged in within the last 30 days)
        $this->activeUsers = User::where('updated_at', '>=', Carbon::now()->subDays(30))->count();
        
        // Today's new users
        $this->newToday = User::whereDate('created_at', Carbon::today())->count();
        
        // In a real application, you would calculate actual revenue
        // This is a placeholder - you would replace with actual revenue logic
        $this->totalRevenue = 0;
            
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

        // Weekly stats
        $this->weeklyStats = User::select(DB::raw('YEARWEEK(created_at, 1) as yearweek'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subWeeks(12))
            ->groupBy('yearweek')
            ->orderBy('yearweek')
            ->get()
            ->map(function ($item) {
                $year = substr($item->yearweek, 0, 4);
                $week = substr($item->yearweek, 4);
                $weekStart = Carbon::now()->setISODate($year, $week);
                
                return [
                    'date' => $weekStart->format('Y-m-d'),
                    'count' => $item->count,
                    'label' => 'Week ' . $weekStart->weekOfYear
                ];
            })
            ->toArray();

        // Monthly stats
        $this->monthlyStats = User::select(
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
        
        // Generate dummy data for the last 14 days
        $startDate = Carbon::now()->subDays(13);
        $this->dailyStats = [];
        
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
            
            $this->dailyStats[] = [
                'date' => $date->format('Y-m-d'),
                'count' => $count,
                'label' => $date->format('M d')
            ];
        }

        // Generate dummy weekly data
        $startWeek = Carbon::now()->subWeeks(11);
        $this->weeklyStats = [];
        
        for ($i = 0; $i < 12; $i++) {
            $date = $startWeek->copy()->addWeeks($i);
            $count = rand(70, 320); // Random data for weeks
            
            // Create some pattern
            if ($i == 3) $count = 380;
            else if ($i == 7) $count = 420;
            else if ($i == 10) $count = 210;
            
            $this->weeklyStats[] = [
                'date' => $date->format('Y-m-d'),
                'count' => $count,
                'label' => 'Week ' . $date->weekOfYear
            ];
        }

        // Generate dummy monthly data
        $startMonth = Carbon::now()->subMonths(11);
        $this->monthlyStats = [];
        
        for ($i = 0; $i < 12; $i++) {
            $date = $startMonth->copy()->addMonths($i);
            $count = rand(300, 1200); // Random data for months
            
            // Create some pattern
            if ($i == 2) $count = 1800;
            else if ($i == 5) $count = 2200;
            else if ($i == 8) $count = 1500;
            
            $this->monthlyStats[] = [
                'date' => $date->format('Y-m-d'),
                'count' => $count,
                'label' => $date->format('M Y')
            ];
        }
    }

    public function getChartData()
    {
        switch ($this->chartView) {
            case 'weekly':
                return $this->weeklyStats;
            case 'monthly':
                return $this->monthlyStats;
            case 'daily':
            default:
                return $this->dailyStats;
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard-stats', [
            'chartData' => $this->getChartData()
        ]);
    }
}