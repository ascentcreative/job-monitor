<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('job_updates', function (Blueprint $table) {
           
            $table->string('sub_message')->after('unit');
            $table->float('sub_amount_completed')->after('sub_message');
            $table->float('sub_total')->after('sub_amount_completed');
            $table->string('sub_unit')->after('sub_total');
  
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
            $table->dropColumn('sub_message');
            $table->dropColumn('sub_amount_completed');
            $table->dropColumn('sub_total');
            $table->dropColumn('sub_unit');

        });
    }
}
