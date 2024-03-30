<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('height');
            $table->string('weight');
            $table->string('gender');
            $table->date('birth');
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('plan_id')->nullable()->index();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->foreignId('create_at')->comment('สร้างเมื่อ timestamps')->nullable();
            $table->foreignId('create_by')->comment('สร้างโดย user_id')->nullable();
            $table->foreignId('update_at')->comment('แก้ไขเมื่อ timestamps')->nullable();
            $table->foreignId('update_by')->comment('แก้ไขโดย user_id')->nullable();
            $table->foreignId('delete_at')->comment('ลบเมื่อ timestamps')->nullable();
            $table->foreignId('delete_by')->comment('ลบโดย user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
