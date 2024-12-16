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
        Schema::create('department_profiles', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->boolean('all_permissions')->default(false);

            $table->timestamps();
        });

        Schema::create('department_profile_permission', function (Blueprint $table) {
            $table->foreignId('department_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_profiles');
        Schema::dropIfExists('department_profile_permission');
    }
};
