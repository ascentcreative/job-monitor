<?php

namespace AscentCreative\JobMonitor\Traits;

use AscentCreative\JobMonitor\Models\JobUpdate;

trait Monitorable {

    private $_monitor_id = null;


    public function startMonitor($total=100, $unit='%') {

         $update = JobUpdate::create([
            'monitor_id' => $this->getMonitorId(),
            'message'=>"Waiting for Job Start",
            'amount_completed'=>0,
            'total'=>$total,
            'unit'=>$unit
        ]);

        $update->save();

    }

    public function updateMonitor($msg, $amount) {

        JobUpdate::updateOrCreate(
            [
                'monitor_id' => $this->getMonitorId(),
            ],
            [
                'message'=>$msg,
                'amount_completed'=>$amount,

        ]);

    }

    public function monitorComplete($msg) {

        JobUpdate::updateOrCreate(
            [
                'monitor_id' => $this->getMonitorId(),
            ],
            [
                'message'=>$msg,
                'is_complete' => true

        ]);

    }

    public function monitorFail($msg) {

        JobUpdate::updateOrCreate(
            [
                'monitor_id' => $this->getMonitorId(),
            ],
            [
                'message'=>$msg,
                'is_error' => true

        ]);

    }

    public function getMonitorId() {

        if (is_null($this->_monitor_id)) {
            $this->_monitor_id = uniqid();
        }

        return $this->_monitor_id;
    }




}




