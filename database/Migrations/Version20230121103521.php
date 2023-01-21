<?php

declare(strict_types=1);

namespace Merjn\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230121103521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create the players table.';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('players');
        $table->addColumn('id', 'integer', [
            'autoincrement' => true,
            'notnull' => true,
        ]);

        // Set id as primary key
        $table->setPrimaryKey(['id']);

        $table->addColumn('username', 'string', [
            'notnull' => true,
            'length' => 255,
        ]);

        $table->addColumn('password', 'string', [
            'notnull' => true,
            'length' => 255,
        ]);

        $table->addColumn('email', 'string', [
            'notnull' => true,
            'length' => 255,
        ]);

        $table->addColumn('gender', 'string', [
            'notnull' => true,
            'length' => 255,
        ]);

        $table->addColumn('figure', 'string', [
            'notnull' => true,
            'length' => 255,
        ]);

        $table->addColumn('motto', 'string', [
            'notnull' => true,
            'length' => 255,
        ]);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('players');
    }
}
