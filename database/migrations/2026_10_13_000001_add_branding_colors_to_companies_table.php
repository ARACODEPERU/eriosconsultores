<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Colores de marca de la instalación (vista Configuraciones → Branding).
     *
     * Nulos = paleta de fábrica del ERP (resources/css/app.css). Al guardar un
     * color, el layout inyecta las variables `--brand-*` y todo el sistema se
     * pinta con la identidad del cliente.
     */
    public function up(): void
    {
        if (! Schema::hasTable('companies')) {
            return;
        }

        if (! Schema::hasColumn('companies', 'brand_primary')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('brand_primary', 9)->nullable()->after('withdrawal_account_number');
            });
        }

        if (! Schema::hasColumn('companies', 'brand_secondary')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('brand_secondary', 9)->nullable()->after('brand_primary');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('companies')) {
            return;
        }

        foreach (['brand_primary', 'brand_secondary'] as $column) {
            if (Schema::hasColumn('companies', $column)) {
                Schema::table('companies', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
