<?php

namespace AscentCreative\JobMonitor\Traits;

use AscentCreative\JobMonitor\Models\JobUpdate;

trait Monitorable {

    protected $_monitor_id = null;

    protected $_monitor_total;

    protected $_submonitor_total;
    protected $_submonitor_amount;


    public function startMonitor($total=100, $unit='%') {

        $this->_monitor_total = $total;

         $update = JobUpdate::create([
            'monitor_id' => $this->getMonitorId(),
            'message'=>"Waiting for Job Start",
            'amount_completed'=>0,
            'total'=>$total,
            'unit'=>$unit
        ]);

        $update->save();

    }

    public function updateMonitor($msg, $amount, $total=null) {

        if(!is_null($total)) {
            $amount = ($amount / $total) * 100;
        } else {
            $amount = ($amount / $this->_monitor_total) * 100;
        }

        JobUpdate::updateOrCreate(
            [
                'monitor_id' => $this->getMonitorId(),
            ],
            [
                'message'=>$msg,
                'amount_completed'=>$amount,

        ]);

    }


    public function startSubMonitor($total=100, $unit='%') {

        $this->_submonitor_total = $total;
        $this->submonitor_amount = 0;

        JobUpdate::updateOrCreate(
            [
                'monitor_id' => $this->getMonitorId(),
            ],
            [
                'sub_message'=>'',
                'sub_amount_completed'=>0,
                'sub_total' => $total,
                'sub_unit' => $unit

        ]);

   }

    public function updateSubMonitor($msg, $amount, $total=null) {

        if(!is_null($total)) {
            $amount = ($amount / $total) * 100;
        }

        $this->submonitor_amount = $amount;

        JobUpdate::updateOrCreate(
            [
                'monitor_id' => $this->getMonitorId(),
            ],
            [
                'sub_message'=>$msg,
                'sub_amount_completed'=>$amount,

        ]);

    }

    public function incrementSubMonitor() {

        $this->submonitor_amount++;

        JobUpdate::updateOrCreate(
            [
                'monitor_id' => $this->getMonitorId(),
            ],
            [
                'sub_amount_completed'=>$this->submonitor_amount,

        ]);

    }

     public function subMonitorComplete() {

        JobUpdate::updateOrCreate(
            [
                'monitor_id' => $this->getMonitorId(),
            ],
            [
                'sub_total' => null,

        ]);

    }

    public function monitorComplete($msg, array $payload = null) {

        JobUpdate::updateOrCreate(
            [
                'monitor_id' => $this->getMonitorId(),
            ],
            [
                'message'=>$msg,
                'is_complete' => true,
                'payload' => $payload,

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




