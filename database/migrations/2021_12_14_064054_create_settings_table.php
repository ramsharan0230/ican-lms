<?php

use App\Models\Setting;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credit')->default(1);
            $table->float('credit_hour_break');
            $table->timestamps();
        });

        Setting::create(['credit'=>'1', 'credit_hour_break'=> '10']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
