<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('reset_tokens', function (Blueprint $table) {
        $table->id();
        $table->string('token');
        $table->timestamp('expires_at');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('reset_tokens');
}

};
