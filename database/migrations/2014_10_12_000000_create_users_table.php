<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->text('alamat');
            $table->integer('usia');
            $table->string('agama');
            $table->string('no_telp');
            $table->string('no_kk');
            $table->string('doc_ktp');
            $table->string('doc_surat_izin');
            $table->enum('status_menikah', ['menikah', 'belom_menikah', 'janda/duda']);
            $table->enum('status_akun', ['approved', 'non_approved']);
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('foto');
            $table->string('ijazah')->nullable();;
            $table->string('surat_nikah')->nullable();;
            $table->string('medical')->nullable();;
            $table->string('bnsp')->nullable();;
            $table->string('bpjs')->nullable();;
            $table->string('pp')->nullable();;
            $table->string('pasport')->nullable();;
            $table->string('pk')->nullable();;
            $table->string('visa')->nullable();;
            $table->string('ektkln')->nullable();;
            $table->enum('status', ['medical', 'blkln', 'rekompassport', 'basmah', 'kbsa', 'visa', 'opp'])->nullable();;
            $table->enum('status_akhir', ['selesai' ,'belum_selesai'])->nullable();;
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
