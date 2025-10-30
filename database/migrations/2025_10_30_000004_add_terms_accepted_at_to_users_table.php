<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'terms_accepted_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('terms_accepted_at')->nullable()->after('email_verified_at');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'terms_accepted_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('terms_accepted_at');
            });
        }
    }
};


