<?php

namespace App\View\Components\Widgets;

use App\Http\Controllers\DashboardController;
use App\Models\Deal;
use App\Service\DashboardService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskWidgets extends Component
{
    /**
     * Create a new component instance.
     */
    public $tasks;
    public $deal;
    public function __construct(DashboardService $dashboardService, $deal = null)
    {
        $this->deal = $deal;
        $this->tasks = $dashboardService->getTasks(auth()->user(), $deal);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.task-widgets');
    }
}
