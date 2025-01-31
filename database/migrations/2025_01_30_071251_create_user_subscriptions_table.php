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
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamp('subscription_expiry_date')->nullable();
            $table->string('subscription_identifier')->nullable();

            // Informações de Pagamento
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->decimal('subscription_price', 10, 2)->nullable(); // Exemplo: 10 dígitos no total, 2 decimais
            $table->string('currency')->nullable();

            // Datas Adicionais
            $table->timestamp('subscription_start_date')->nullable();
            $table->timestamp('next_billing_date')->nullable();
            $table->timestamp('cancellation_date')->nullable();
            $table->timestamp('trial_ends_at')->nullable();

            // Outros Status
            $table->string('subscription_status')->nullable(); // Ex: 'active', 'cancelled', etc.
            $table->boolean('is_recurring')->default(true); // Assumindo que por padrão é recorrente

            $table->timestamps();
            $table->unique(['user_id', 'product_id']);
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
