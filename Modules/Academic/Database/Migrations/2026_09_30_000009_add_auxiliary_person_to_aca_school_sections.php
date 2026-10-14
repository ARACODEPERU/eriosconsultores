<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('aca_school_sections')) {
            return;
        }

        // La columna y su foreign key se crean en el mismo ALTER, asi que basta
        // comprobar la columna: si ya existe, la clave tambien.
        if (! Schema::hasColumn('aca_school_sections', 'auxiliary_person_id')) {
            Schema::table('aca_school_sections', function (Blueprint $table) {
                $table->unsignedBigInteger('auxiliary_person_id')->nullable()->after('tutor_person_id')->comment('Docente auxiliar (typ. Inicial)');
                $table->foreign('auxiliary_person_id')->references('id')->on('people')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('aca_school_sections')) {
            return;
        }

        if (Schema::hasColumn('aca_school_sections', 'auxiliary_person_id')) {
            Schema::table('aca_school_sections', function (Blueprint $table) {
                $table->dropForeign(['auxiliary_person_id']);
                $table->dropColumn('auxiliary_person_id');
            });
        }
    }
};
