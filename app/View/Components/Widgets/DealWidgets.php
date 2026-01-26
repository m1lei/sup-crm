<?php

namespace App\View\Components\Widgets;

use App\Service\DashboardService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DealWidgets extends Component
{
    public $deals;
    /**
     * Create a new component instance.
     */
    public function __construct(DashboardService $dashboardService)
    {
        //
        $this->deals = $dashboardService->getDeal(auth()->user());
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.deal-widgets');
    }
}
