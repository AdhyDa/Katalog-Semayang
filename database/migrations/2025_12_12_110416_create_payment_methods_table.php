<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('payment_methods');
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // bri, bca, dana, cod
            $table->string('name'); // Bank BRI, DANA, dll
            $table->string('type'); // manual (rekening), qr (qris), cash (cod)
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('qr_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
};
