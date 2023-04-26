<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Licencetype;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('job_updates', function(Blueprint $table) {

            $table->text('payload')->nullable()->change();

        });


    }

    public function down()
    {

        Schema::table('job_updates', function(Blueprint $table) {

            $table->text('payload')->nullable(false)->change();

        });

    }


};