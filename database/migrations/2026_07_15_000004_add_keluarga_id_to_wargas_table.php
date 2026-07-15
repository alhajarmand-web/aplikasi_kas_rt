<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('wargas', function (Blueprint $table) {
            $table->unsignedBigInteger('keluarga_id')->nullable()->after('id');
            $table->foreign('keluarga_id')->references('id')->on('keluargas')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('wargas', function (Blueprint $table) {
            $table->dropForeign(['keluarga_id']);
            $table->dropColumn('keluarga_id');
        });
    }
};
