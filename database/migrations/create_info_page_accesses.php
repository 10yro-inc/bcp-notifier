<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_page_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('user_cd',200);
            $table->string('company_cd',200);
            $table->bigInteger('notification_log_id',false,true);
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
        Schema::dropIfExists('info_page_accesses');
    }
};
