<?php

namespace AscentCreative\JobMonitor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobUpdate extends Model {

    use HasFactory;

    public $fillable = ['monitor_id', 'message', 'amount_completed', 'total', 'unit', 'is_complete', 'is_error', 'payload'];

    //public $visible = ['message', 'is_complete', 'percent_complete'];

    public $appends = ['percent_complete'];

    public function getPercentCompleteAttribute() {
        
        if ($this->is_complete == 1) {
            return 100;
        }

        return ($this->amount_completed / $this->total) * 100;
    }

}