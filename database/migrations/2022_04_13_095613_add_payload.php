<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('job_updates', function (Blueprint $table) {
           
            $table->text('payload')->after('is_error');
  
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('job_updates', function (Blueprint $table) {
            $table->dropColumn('payload');
        });
    }
}
