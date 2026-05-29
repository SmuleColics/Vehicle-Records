<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    DB::statement("UPDATE users SET gender = 'Male' WHERE gender = 'male'");
    DB::statement("UPDATE users SET gender = 'Female' WHERE gender = 'female'");
    DB::statement("UPDATE users SET gender = 'Other' WHERE gender = 'other'");

    Schema::table('users', function (Blueprint $table) {
      $table->enum('gender', ['Male', 'Female', 'Other'])->nullable()->change();
    });
  }

  public function down()
  {
    DB::statement("UPDATE users SET gender = 'male' WHERE gender = 'Male'");
    DB::statement("UPDATE users SET gender = 'female' WHERE gender = 'Female'");
    DB::statement("UPDATE users SET gender = 'other' WHERE gender = 'Other'");

    Schema::table('users', function (Blueprint $table) {
      $table->enum('gender', ['male', 'female', 'other'])->nullable()->change();
    });
  }
};
