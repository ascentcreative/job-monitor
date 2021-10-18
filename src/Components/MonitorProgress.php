<?php

namespace AscentCreative\JobMonitor\Components;

use Illuminate\View\Component;

class MonitorProgress extends Component
{

    public $monitorid;
   

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($monitorid)
    {
        $this->monitorid = $monitorid;
       
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('jobmonitor::components.monitorprogress');
    }
}
