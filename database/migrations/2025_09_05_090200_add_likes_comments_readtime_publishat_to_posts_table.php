<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->bigInteger('likes')->default(0);
            $table->bigInteger('comments')->default(0);
            $table->integer('read_time')->default(0); // in minutes
            $table->timestamp('publish_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['likes', 'comments', 'read_time', 'publish_at']);
        });
    }
};