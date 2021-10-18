<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_updates', function (Blueprint $table) {
            $table->id();
            $table->varchar('monitor_id', 10);
            $table->string('message');
            $table->float('amount_completed');
            $table->float('total');
            $table->string('unit');
            $table->timestamps();
        });





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_updates');
    }
}
