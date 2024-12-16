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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('abbreviation');

            $table->foreignId('parent_id')->nullable()->constrained('departments')->nullOnDelete();

            $table->string('primary_identifier')->nullable();
            $table->string('secondary_identifier')->nullable();
            
            $table->foreignId('department_profile_id')->constrained()->cascadeOnDelete();

            $table->boolean('is_recruiting')->default(true);
            $table->integer('max_full_time')->default(0);
            $table->integer('max_part_time')->default(0);


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
