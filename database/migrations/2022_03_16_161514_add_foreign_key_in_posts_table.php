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
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger("category_id")
            ->nullable()
            ->after("slug");


            $table->foreign("category_id")
                ->references("id")
                ->on("categories");



            // $table->unsignedBigInteger("user_id")->nullable();

            // $table->foreign("user_id")
            //     ->references("id")
            //     ->on("users");    

            $table->foreignId("user_id")
                ->nullable()
                ->after("category_id")
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign("posts_category_id_foreign");
            $table->dropColumn("category_id");

            $table->dropForeign("posts_user_id_foreign");
            $table->dropColumn("user_id");
        });
    }
};
