<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('registration_code')->unique();
            $table->string('name'); $table->string('nickname')->nullable(); $table->string('gender');
            $table->string('nisn')->nullable(); $table->string('nik')->nullable();
            $table->string('birth_place')->nullable(); $table->date('birth_date')->nullable();
            $table->string('religion')->nullable(); $table->string('phone')->nullable(); $table->string('email')->nullable();
            $table->text('address')->nullable(); $table->string('previous_school')->nullable();
            $table->string('parent_name')->nullable(); $table->string('parent_phone')->nullable();
            $table->string('status')->default('Menunggu Verifikasi'); $table->string('payment_status')->default('belum lunas');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('applicants'); }
};
