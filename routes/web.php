<?php

use AscentCreative\JobMonitor\Models\JobUpdate;

Route::middleware('web')->group( function() {

    Route::get('/job-monitor/poll/{update:monitor_id}', function(JobUpdate $update) { 
        return $update;
    })->name('jobmonitor.poll');


}); //->middleware('web');

