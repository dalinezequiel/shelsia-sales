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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_plan');
            $table->string('description');
            $table->string('category');
            $table->string('supplier');
            $table->date('due_date');
            $table->decimal('amount','10','2');
            $table->date('date_of_issue');
            $table->string('document_number');
            $table->string('occurrence');
            $table->string('observation');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
