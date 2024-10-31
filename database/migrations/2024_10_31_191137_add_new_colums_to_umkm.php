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
        Schema::table('umkms', function (Blueprint $table) {
            $table->bigInteger('assets');
            $table->string('area');
            $table->integer('market_share');
            $table->string('sertifikasi');
            $table->bigInteger('Pendanaan');
            $table->string('peruntukan');
            $table->text('Rencana');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            //
        });
    }
};
