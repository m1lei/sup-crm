<?php

namespace App\View\Components\Widgets;

use App\Service\DashboardService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActivityWidgets extends Component
{
    public $recentActivities;
    public $deal;
    /**
     * Create a new component instance.
     */
    public function __construct(DashboardService $dashboardService, $deal = null)
    {
        //
        $this->deal = $deal;
        $this->recentActivities = $dashboardService->getActivities(auth()->user(), $deal);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.activity-widgets');
    }
}
