<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('instance_name')->index();
            $table->float('cpu')->nullable();
            $table->float('memory')->nullable();
            $table->float('disk')->nullable();
            $table->unsignedBigInteger('occurred')->default(0);
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
        Schema::dropIfExists('monitoring_alerts');
    }
}
