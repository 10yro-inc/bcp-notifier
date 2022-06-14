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
            $table->bigInteger('bcp_user_id',false,true);
            $table->bigInteger('company_id',false,true);
            $table->bigInteger('notification_log_id',false,true);
            $table->timestamp('accessed_at');
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
