<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routers', function (Blueprint $table) {
            $table->id();
            $table->string('sap_id', 18);
            $table->string('hostname', 50);
            $table->ipAddress('loopback');
            $table->string('mac_address', 17);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['loopback', 'hostname']);
            $table->unique(['loopback', 'hostname']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routers');
    }
}
