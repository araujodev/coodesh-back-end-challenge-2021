<?php

use App\Enumerators\AuthorizationStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('authorizations', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('sha1_value');
            $table->enum('status', [AuthorizationStatusEnum::ACTIVE, AuthorizationStatusEnum::INACTIVE]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('authorizations');
    }
}
