<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Prórroga y override de tiempos por partido.
     *
     * score_h / score_a siguen siendo el marcador final (incluye la prórroga);
     * score_regular_h / score_regular_a guardan el marcador al terminar el
     * tiempo reglamentario, que es el que obliga a jugar la prórroga.
     */
    public function up(): void
    {
        if (! Schema::hasTable('event_edition_matches')) {
            return;
        }

        if (! Schema::hasColumn('event_edition_matches', 'half_minutes_override')) {
            Schema::table('event_edition_matches', function (Blueprint $table) {
                // Override de tiempos solo para este partido (null = usa la edición)
                $table->unsignedSmallInteger('half_minutes_override')->nullable()->after('location');
            });
        }

        if (! Schema::hasColumn('event_edition_matches', 'halves_override')) {
            Schema::table('event_edition_matches', function (Blueprint $table) {
                $table->unsignedTinyInteger('halves_override')->nullable()->after('half_minutes_override');
            });
        }

        if (! Schema::hasColumn('event_edition_matches', 'extra_half_minutes_override')) {
            Schema::table('event_edition_matches', function (Blueprint $table) {
                $table->unsignedSmallInteger('extra_half_minutes_override')->nullable()->after('halves_override');
            });
        }

        if (! Schema::hasColumn('event_edition_matches', 'extra_time_played')) {
            Schema::table('event_edition_matches', function (Blueprint $table) {
                // ¿Se jugó la prórroga? y el marcador al final del tiempo reglamentario
                $table->boolean('extra_time_played')->default(false)->after('penalties');
            });
        }

        if (! Schema::hasColumn('event_edition_matches', 'score_regular_h')) {
            Schema::table('event_edition_matches', function (Blueprint $table) {
                $table->unsignedTinyInteger('score_regular_h')->nullable()->after('extra_time_played');
            });
        }

        if (! Schema::hasColumn('event_edition_matches', 'score_regular_a')) {
            Schema::table('event_edition_matches', function (Blueprint $table) {
                $table->unsignedTinyInteger('score_regular_a')->nullable()->after('score_regular_h');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('event_edition_matches')) {
            return;
        }

        foreach (['half_minutes_override', 'halves_override', 'extra_half_minutes_override', 'extra_time_played', 'score_regular_h', 'score_regular_a'] as $column) {
            if (Schema::hasColumn('event_edition_matches', $column)) {
                Schema::table('event_edition_matches', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
