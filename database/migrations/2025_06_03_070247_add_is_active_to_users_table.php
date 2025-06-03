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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->boolean('is_active')->default(true)->after('role')->comment('Indicates if the user is active');
            $table->timestamp('last_login_at')->nullable()->after('is_active')->comment('Timestamp of the last login');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('is_active');
            $table->dropColumn('last_login_at');
        });
    }
};
