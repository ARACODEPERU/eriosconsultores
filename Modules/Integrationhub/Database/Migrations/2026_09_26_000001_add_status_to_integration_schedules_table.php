<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Estado de la ultima ejecucion programada de una integracion, para poder
     * mostrarlo en el panel sin depender del log.
     *
     * Idempotente: cada columna se verifica antes de crearse. La migracion ya
     * corrio en algunas instalaciones sin quedar registrada, asi que volver a
     * ejecutar `php artisan migrate` no debe romper con "Duplicate column name".
     */
    public function up(): void
    {
        if (!Schema::hasTable('integration_schedules')) {
            return;
        }

        if (!Schema::hasColumn('integration_schedules', 'last_status')) {
            Schema::table('integration_schedules', function (Blueprint $table) {
                $table->string('last_status', 20)
                    ->nullable()
                    ->after('last_executed_at')
                    ->comment('Estado de la última ejecución: pending, running, success o failed');
            });
        }

        if (!Schema::hasColumn('integration_schedules', 'last_error')) {
            Schema::table('integration_schedules', function (Blueprint $table) {
                $table->text('last_error')
                    ->nullable()
                    ->after('last_status')
                    ->comment('Detalle del último fallo (vacío si todo fue bien)');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('integration_schedules')) {
            return;
        }

        if (Schema::hasColumn('integration_schedules', 'last_error')) {
            Schema::table('integration_schedules', function (Blueprint $table) {
                $table->dropColumn('last_error');
            });
        }

        if (Schema::hasColumn('integration_schedules', 'last_status')) {
            Schema::table('integration_schedules', function (Blueprint $table) {
                $table->dropColumn('last_status');
            });
        }
    }
};
