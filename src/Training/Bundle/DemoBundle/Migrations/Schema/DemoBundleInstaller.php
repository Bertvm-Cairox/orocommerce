<?php

namespace Training\Bundle\DemoBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class DemoBundleInstaller implements Installation
{
    /**
     * @inheritDoc
     */
    public function getMigrationVersion(): string
    {
        return 'v1_0';
    }

    /**
     * @inheritDoc
     */
    public function up(Schema $schema, QueryBag $queries): void
    {
        /** Tables generation **/
        $this->createAppDemoPriorityTable($schema);
        $this->createAppDemoDocumentTable($schema);

        /** Foreign keys generation **/
        $this->addAppDemoDocumentForeignKeys($schema);
    }

    /**
     * Create app_demo_priority table
     */
    private function createAppDemoPriorityTable(Schema $schema): void
    {
        $table = $schema->createTable('app_demo_priority');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('label', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
    }

    /**
     * Create app_demo_document table
     */
    private function createAppDemoDocumentTable(Schema $schema): void
    {
        $table = $schema->createTable('app_demo_document');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('priority_id', 'integer', ['notnull' => false]);
        $table->addColumn('subject', 'string', ['length' => 255]);
        $table->addColumn('description', 'string', ['length' => 255]);
        $table->addColumn('due_date', 'datetime', ['notnull' => false]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['priority_id'], 'idx_40be8f84497b19f9', []);
    }

    /**
     * Add app_demo_document foreign keys.
     */
    private function addAppDemoDocumentForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('app_demo_document');
        $table->addForeignKeyConstraint(
            $schema->getTable('app_demo_priority'),
            ['priority_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
    }
}