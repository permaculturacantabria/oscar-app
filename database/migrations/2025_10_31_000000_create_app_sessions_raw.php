<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Crear tabla usando SQL directo (más confiable)
        DB::statement("CREATE TABLE IF NOT EXISTS `app_sessions` (
            `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `user_id` BIGINT UNSIGNED NOT NULL,
            `listener_id` BIGINT UNSIGNED NULL,
            `listener_name` VARCHAR(255) NULL,
            `scheduled_at` DATETIME NOT NULL,
            `status` ENUM('pendiente', 'realizada') NOT NULL DEFAULT 'pendiente',
            `notes` TEXT NULL,
            `categories` JSON NULL,
            `created_at` TIMESTAMP NULL,
            `updated_at` TIMESTAMP NULL,
            INDEX `app_sessions_user_id_index` (`user_id`),
            INDEX `app_sessions_listener_id_index` (`listener_id`),
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`listener_id`) REFERENCES `listeners`(`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    }

    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS `app_sessions`');
    }
};

