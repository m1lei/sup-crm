<?php

namespace App\View\Components\Widgets;

use App\Service\DashboardService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class ActivityWidgets extends Component
{
    public $recentActivities;
    public ?Model $subject;//объект модели
    /**
     * Create a new component instance.
     * если subject = null, то возвращаются все activity
     */
    public function __construct(DashboardService $dashboardService, ?Model $subject = null)
    {
        //
        $this->subject = $subject;
        $this->recentActivities = $dashboardService->getActivities(auth()->user(), $subject);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.activity-widgets');
    }
}
