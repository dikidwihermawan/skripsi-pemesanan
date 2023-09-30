<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained('users')->onDelete('cascade');
            $table->foreignId('translation_id')->after('user_id')->constrained('translations')->onDelete('cascade');
            $table->foreignId('file_id')->after('translation_id')->constrained('files')->onDelete('cascade');
            $table->foreignId('upload_file_id')->after('file_id')->nullable()->constrained('upload_files')->onDelete('cascade');
            $table->foreignId('payment_id')->after('upload_file_id')->nullable()->constrained('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
