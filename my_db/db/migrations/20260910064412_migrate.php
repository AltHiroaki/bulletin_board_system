<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Migrate extends AbstractMigration
{
    public function up()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS trx_users (
                `id` int unsigned NOT NULL AUTO_INCREMENT,
                `user_name` varchar(40) NOT NULL,
                `password` varchar(255) NOT NULL,
                PRIMARY KEY (`id`)
            );
        ");

        $this->execute("
            CREATE TABLE IF NOT EXISTS trx_comments (
                `id` int unsigned NOT NULL AUTO_INCREMENT,
                `user_id` int unsigned NOT NULL,
                `like_count` int NOT NULL DEFAULT 0,
                `text` varchar(255) NOT NULL,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`user_id`) REFERENCES trx_users(`id`)
            );
        ");
        
    }

    public function down()
    {
        $this->execute("
            DROP TABLE IF EXISTS trx_comments;
        ");

        $this->execute("
            DROP TABLE IF EXISTS trx_users;
        ");
    }
}
