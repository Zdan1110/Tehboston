<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tb_akun', function (Blueprint $table) {
            $table->id(); // Auto-increment ID otomatis di-generate
            $table->string('nama');
            $table->string('no_hp');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('type_akun')->default('user'); // Benar
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_akun');
    }
};

