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
    Schema::create('vehicles', function (Blueprint $table) {
      $table->id();
      $table->string('plate');
      $table->string('brand');
      $table->string('model');
      $table->year('year');
      $table->string('type');
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->timestamp('created_at')->useCurrent();
      $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('vehicles');
  }
};
