<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperations extends Migration
{
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type');
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('sum')->nullable();
            $table->string('sender_type');
            $table->string('receiver_type');
            $table->jsonb('sender')->default('{}');
            $table->jsonb('receiver')->default('{}');
        });
    }

    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
