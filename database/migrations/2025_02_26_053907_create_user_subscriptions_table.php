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
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subscription_user_id');

            $table->index('user_id', 'user_subscription_user_idx');
            $table->index('subscription_user_id', 'user_subscription_user_subscription_user_idx');

            $table->foreign('user_id', 'user_subscription_user_fk')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subscription_user_id', 'user_subscription_user_subscription_user_fk')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subscriptions');
    }
};
