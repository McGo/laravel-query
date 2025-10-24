<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mocked_models', function (Blueprint $table) {
            $table->id();
            $table->uuid('a_uuid_field')->nullable();;
            $table->string('a_string_field')->nullable();
            $table->boolean('a_boolean_field')->nullable();
            $table->text('a_text_field')->nullable();
            $table->json('a_json_field')->nullable();
            $table->unsignedInteger('a_integer_field')->nullable();
            $table->date('a_date_field')->nullable();
            $table->dateTime('a_datetime_field')->nullable();
            $table->timestamp('a_timestamp_field')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mocked_model');
    }
};