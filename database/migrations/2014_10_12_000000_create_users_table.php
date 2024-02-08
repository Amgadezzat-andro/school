<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // Student Info
            $table->string('last_name', 255)->nullable();

            $table->string('email')->unique();
            $table->integer('user_type')->default(3);
            $table->tinyInteger('is_delete')->default(0);

            // Student Info
            $table->tinyInteger('status')->nullable()->default(0);


            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Student Info
            $table->string('admission_number', 50)->nullable();
            $table->string('roll_number', 50)->nullable();
            $table->integer('class_id')->nullable();
            $table->string('gender', 50)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('caste', 50)->nullable();
            $table->string('religion', 50)->nullable();
            $table->string('mobile_number', 15)->nullable();
            $table->date('admission_date')->nullable();
            $table->string('profile_pic', 100)->nullable();
            $table->string('blood_group', 100)->nullable();
            $table->string('height', 100)->nullable();
            $table->string('weight', 100)->nullable();


            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
