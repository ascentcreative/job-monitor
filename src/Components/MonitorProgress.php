<?php

namespace AscentCreative\JobMonitor\Components;

use Illuminate\View\Component;

class MonitorProgress extends Component
{

    public $monitorid;

    public $freq;
   

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($monitorid, $freq=null)
    {
        $this->monitorid = $monitorid;

        $this->freq = $freq;
       
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
