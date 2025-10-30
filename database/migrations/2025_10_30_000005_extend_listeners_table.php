<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('listeners')) {
            Schema::table('listeners', function (Blueprint $table) {
                if (!Schema::hasColumn('listeners', 'last_name')) {
                    $table->string('last_name')->nullable()->after('name');
                }
                if (!Schema::hasColumn('listeners', 'email')) {
                    $table->string('email')->nullable()->after('last_name');
                }
                if (!Schema::hasColumn('listeners', 'phone')) {
                    $table->string('phone')->nullable()->after('email');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('listeners')) {
            Schema::table('listeners', function (Blueprint $table) {
                if (Schema::hasColumn('listeners', 'phone')) $table->dropColumn('phone');
                if (Schema::hasColumn('listeners', 'email')) $table->dropColumn('email');
                if (Schema::hasColumn('listeners', 'last_name')) $table->dropColumn('last_name');
            });
        }
    }
};


