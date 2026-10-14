<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tiempos configurables por edición. Los defaults son solo un preset:
     * cada torneo define sus propios minutos por tiempo.
     */
    public function up(): void
    {
        if (! Schema::hasTable('event_editions')) {
            return;
        }

        if (! Schema::hasColumn('event_editions', 'regular_half_minutes')) {
            Schema::table('event_editions', function (Blueprint $table) {
                // Tiempo reglamentario
                $table->unsignedSmallInteger('regular_half_minutes')->default(20)->after('max_players_per_team');
            });
        }

        if (! Schema::hasColumn('event_editions', 'regular_halves')) {
            Schema::table('event_editions', function (Blueprint $table) {
                $table->unsignedTinyInteger('regular_halves')->default(2)->after('regular_half_minutes');
            });
        }

        if (! Schema::hasColumn('event_editions', 'extra_half_minutes')) {
            Schema::table('event_editions', function (Blueprint $table) {
                // Tiempo suplementario (prórroga)
                $table->unsignedSmallInteger('extra_half_minutes')->default(10)->after('regular_halves');
            });
        }

        if (! Schema::hasColumn('event_editions', 'extra_halves')) {
            Schema::table('event_editions', function (Blueprint $table) {
                $table->unsignedTinyInteger('extra_halves')->default(2)->after('extra_half_minutes');
            });
        }

        if (! Schema::hasColumn('event_editions', 'extra_time_enabled')) {
            Schema::table('event_editions', function (Blueprint $table) {
                // La prórroga es opcional y arranca apagada: solo se habilita en
                // fases de eliminación directa cuando el organizador la pide.
                $table->boolean('extra_time_enabled')->default(false)->after('extra_halves');
            });
        }

        if (! Schema::hasColumn('event_editions', 'max_substitutions')) {
            Schema::table('event_editions', function (Blueprint $table) {
                // Límite de cambios (avisa, no bloquea) y cupo extra en la prórroga
                $table->unsignedTinyInteger('max_substitutions')->nullable()->after('extra_time_enabled');
            });
        }

        if (! Schema::hasColumn('event_editions', 'extra_substitution_enabled')) {
            Schema::table('event_editions', function (Blueprint $table) {
                $table->boolean('extra_substitution_enabled')->default(true)->after('max_substitutions');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('event_editions')) {
            return;
        }

        foreach (['regular_half_minutes', 'regular_halves', 'extra_half_minutes', 'extra_halves', 'extra_time_enabled', 'max_substitutions', 'extra_substitution_enabled'] as $column) {
            if (Schema::hasColumn('event_editions', $column)) {
                Schema::table('event_editions', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
