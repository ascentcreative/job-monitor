<?php

namespace AscentCreative\JobMonitor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobUpdate extends Model {

    use HasFactory;

    public $fillable = ['monitor_id', 'message', 'amount_completed', 'total', 'unit', 'sub_message', 'sub_amount_completed', 'sub_total', 'sub_unit', 'is_complete', 'is_error', 'payload'];

    public $connection = 'mysql_job_monitor';

    //public $visible = ['message', 'is_complete', 'percent_complete'];

    public $appends = ['percent_complete', 'sub_percent_complete', 'message_html'];

    public function getPercentCompleteAttribute() {
        
        if ($this->is_complete == 1) {
            return 100;
        }

        return ($this->amount_completed / $this->total) * 100;
    }

    public function getSubPercentCompleteAttribute() {
        
        if ($this->is_complete == 1) {
            return 100;
        }

        if($this->sub_total == 0) {
            return 0;
        }
        
        return ($this->sub_amount_completed / $this->sub_total) * 100;
    }

    public function getMessageHtmlAttribute() {
        return nl2br($this->message);
    }

}