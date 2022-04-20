<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUser.
 */
class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table): void {
            $table->id()
                  ->comment('user id');

            $table->string('email')
                  ->unique()
                  ->comment('user email unique');

            $table->string('password')
                  ->comment('user email unique');

            $table->string('api_token')
                  ->nullable()
                  ->unique()
                  ->comment('api token');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
}
