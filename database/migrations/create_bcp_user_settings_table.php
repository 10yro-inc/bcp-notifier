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
        Schema::create('bcp_user_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bcp_user_id',false,true);
            $table->string('earthquake_cd',2);
            $table->string('pref1',2)->nullable();
            $table->string('pref2',2)->nullable();
            $table->string('pref3',2)->nullable();
            $table->string('pref4',2)->nullable();
            $table->string('pref5',2)->nullable();
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
        Schema::dropIfExists('bcp_user_settings');
    }
};
