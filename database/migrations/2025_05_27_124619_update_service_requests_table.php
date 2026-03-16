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
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropForeign(['service_id']); // Eğer foreign key varsa
            $table->dropColumn('service_id');
            $table->string('service_type')->after('user_id');
            $table->string('service_option')->after('service_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->foreignId('service_id')->nullable()->constrained();
            $table->dropColumn(['service_type', 'service_option']);
        });
    }
};
