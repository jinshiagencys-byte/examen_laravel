<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_loan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id')->index();
            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->unsignedBigInteger('asset_id')->index();
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
            $table->boolean('returned')->default(false);
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
        Schema::dropIfExists('asset_loan');
    }
}
