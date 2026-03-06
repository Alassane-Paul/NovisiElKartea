<?php

namespace App\Http\View\Composers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $navProjects = Project::active()
            ->orderBy('id', 'desc')
            ->get();

        $navServices = Service::where('active', true)
            ->orderBy('order')
            ->get();

        $view->with([
            'navProjects' => $navProjects,
            'navServices' => $navServices,
        ]);
    }
}
