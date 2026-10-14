<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Moneda de la compra y tipo de cambio aplicado el dia de la compra:
     * el comprobante (boleta/factura) se emite en esa moneda usando ese TC,
     * aunque el documento se genere dias despues.
     *
     * Idempotente: cada columna se verifica antes de crearse. La migracion ya se
     * habia ejecutado a medias en algunas instalaciones (la columna `currency`
     * existia pero la migracion no quedo registrada), asi que volver a correr
     * `php artisan migrate` no debe romper con "Duplicate column name".
     */
    public function up(): void
    {
        if (!Schema::hasTable('onli_sales')) {
            return;
        }

        if (!Schema::hasColumn('onli_sales', 'currency')) {
            Schema::table('onli_sales', function (Blueprint $table) {
                $table->string('currency', 5)->default('PEN')->after('traffic_source');
            });
        }

        if (!Schema::hasColumn('onli_sales', 'exchange_rate')) {
            Schema::table('onli_sales', function (Blueprint $table) {
                $table->decimal('exchange_rate', 10, 4)->nullable()->after('currency');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('onli_sales')) {
            return;
        }

        if (Schema::hasColumn('onli_sales', 'exchange_rate')) {
            Schema::table('onli_sales', function (Blueprint $table) {
                $table->dropColumn('exchange_rate');
            });
        }

        if (Schema::hasColumn('onli_sales', 'currency')) {
            Schema::table('onli_sales', function (Blueprint $table) {
                $table->dropColumn('currency');
            });
        }
    }
};
