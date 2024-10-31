<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company')->nullable();
            $table->string('address');
            $table->string('address_2')->nullable();
            $table->string('postal_code');
            $table->string('city');
            $table->string('country')->default('France');
            $table->string('phone')->nullable();
            $table->enum('payment_status', ['En attente de paiement', 'Payé', 'Annulé', 'Expédié', 'Reçu'])->default('En attente de paiement');
            $table->string('payment_method')->nullable(); // ex: Paypal, Stripe, Crypto
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
