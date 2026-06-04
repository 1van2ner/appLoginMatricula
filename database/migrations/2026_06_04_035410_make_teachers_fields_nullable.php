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
        Schema::table('teachers', function (Blueprint $table) {
            try {
                $table->dropUnique('teachers_dni_unique');
            } catch (\Exception $e) {
                // ignore if index does not exist
            }
            try {
                $table->dropUnique('teachers_email_unique');
            } catch (\Exception $e) {
                // ignore if index does not exist
            }

            $table->string('dni', 8)->nullable()->change();
            $table->string('email', 150)->nullable()->change();
            $table->string('telefono', 20)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('dni', 8)->nullable(false)->change();
            $table->string('email', 150)->nullable(false)->change();
            $table->string('telefono', 20)->nullable(false)->change();
            try {
                $table->unique('dni');
            } catch (\Exception $e) {
                // ignore if unique index already exists or cannot be created
            }
            try {
                $table->unique('email');
            } catch (\Exception $e) {
                // ignore if unique index already exists or cannot be created
            }
        });
    }
};
