<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->double('jumlah_tbr');
            $table->double('size_bnh');
            $table->double('size_pnn');
            $table->double('lama_plhr');
            $table->date('tanggal_tbr');
            $table->double('kelangsungan_hdp');
            $table->double('FRAwal');
            $table->double('FRAkhir');
            $table->double('SelisihFR');
            $table->double('rerata_awal');
            $table->double('biomas_awal');
            $table->double('rerata_akhir');
            $table->double('laju_pertumbuhan');
            $table->double('kematian');
            $table->double('kematian_harian');
            $table->double('t_bobot');
            $table->double('t_kelangsungan_hidup');
            $table->double('t_ikan_hdp');
            $table->double('t_biomas');
            $table->double('t_fr');
            $table->double('t_pakan_harian');
            $table->double('t_pakan_kumulatif');
            $table->double('total_kebutuhan_pakan');
            $table->double('FCR');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
