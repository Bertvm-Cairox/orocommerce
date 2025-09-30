<?php

namespace Training\Bundle\CollectOnDeliveryBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class CollectOnDeliveryBundleInstaller implements Installation
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
        $this->createAcmeCollOnDelivTransLabelTable($schema);
        $this->createAcmeCollOnDelivShortLabelTable($schema);
        $this->createOroIntegrationTransportTable($schema);

        /** Foreign keys generation **/
        $this->addAcmeCollOnDelivTransLabelForeignKeys($schema);
        $this->addAcmeCollOnDelivShortLabelForeignKeys($schema);
        $this->addOroIntegrationTransportForeignKeys($schema);
    }

    /**
     * Create acme_coll_on_deliv_trans_label table
     */
    private function createAcmeCollOnDelivTransLabelTable(Schema $schema): void
    {
        $table = $schema->createTable('acme_coll_on_deliv_trans_label');
        $table->addColumn('transport_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['transport_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'uniq_13476d06eb576e89');
        $table->addIndex(['transport_id'], 'idx_13476d069909c13f', []);
    }

    /**
     * Create acme_coll_on_deliv_short_label table
     */
    private function createAcmeCollOnDelivShortLabelTable(Schema $schema): void
    {
        $table = $schema->createTable('acme_coll_on_deliv_short_label');
        $table->addColumn('transport_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['transport_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'uniq_2c81a8dceb576e89');
        $table->addIndex(['transport_id'], 'idx_2c81a8dc9909c13f', []);
    }

    /**
     * Create oro_integration_transport table
     */
    private function createOroIntegrationTransportTable(Schema $schema): void
    {
        $table = $schema->createTable('oro_integration_transport');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('ups_country_code', 'string', ['notnull' => false, 'length' => 2]);
        $table->addColumn('type', 'string', ['length' => 30]);
        $table->addColumn('money_order_pay_to', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('money_order_send_to', 'text', ['notnull' => false]);
        $table->addColumn('pp_express_checkout_action', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('pp_credit_card_action', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('pp_allowed_card_types', 'array', ['notnull' => false, 'comment' => '(DC2Type:array)']);
        $table->addColumn('pp_express_checkout_name', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('pp_partner', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_vendor', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_user', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_password', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_test_mode', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('pp_debug_mode', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('pp_require_cvv_entry', 'boolean', ['default' => '1', 'notnull' => false]);
        $table->addColumn('pp_zero_amount_authorization', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('pp_auth_for_req_amount', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('pp_use_proxy', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('pp_proxy_host', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_proxy_port', 'crypted_string', ['notnull' => false, 'length' => 255, 'comment' => '(DC2Type:crypted_string)']);
        $table->addColumn('pp_enable_ssl_verification', 'boolean', ['default' => '1', 'notnull' => false]);
        $table->addColumn('orocrm_zd_email', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('orocrm_zd_url', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_zd_token', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_zd_default_user_email', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('orocrm_dm_api_username', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_dm_api_password', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_dm_api_client_id', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_dm_api_client_key', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('orocrm_dm_api_custom_domain', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('fedex_test_mode', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('fedex_ignore_package_dimension', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('fedex_key', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_password', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_client_id', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('fedex_client_secret', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('fedex_access_token', 'text', ['notnull' => false]);
        $table->addColumn('fedex_access_token_expires', 'datetime', ['notnull' => false]);
        $table->addColumn('fedex_account_number', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_account_number_rest', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_meter_number', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_pickup_type', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_pickup_type_rest', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('fedex_unit_of_weight', 'string', ['notnull' => false, 'length' => 3]);
        $table->addColumn('fedex_invalidate_cache_at', 'datetime', ['notnull' => false]);
        $table->addColumn('ups_test_mode', 'boolean', ['default' => '', 'notnull' => false]);
        $table->addColumn('ups_api_user', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ups_api_password', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ups_api_key', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ups_client_id', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ups_client_secret', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ups_access_token', 'text', ['notnull' => false]);
        $table->addColumn('ups_access_token_expires', 'datetime', ['notnull' => false]);
        $table->addColumn('ups_shipping_account_number', 'string', ['notnull' => false, 'length' => 100]);
        $table->addColumn('ups_shipping_account_name', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('ups_pickup_type', 'string', ['notnull' => false, 'length' => 2]);
        $table->addColumn('ups_unit_of_weight', 'string', ['notnull' => false, 'length' => 3]);
        $table->addColumn('ups_invalidate_cache_at', 'datetime', ['notnull' => false]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['type'], 'oro_int_trans_type_idx', []);
        $table->addIndex(['ups_country_code'], 'idx_d7a389a87cdff63f', []);
    }

    /**
     * Add acme_coll_on_deliv_trans_label foreign keys.
     */
    private function addAcmeCollOnDelivTransLabelForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('acme_coll_on_deliv_trans_label');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_integration_transport'),
            ['transport_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'CASCADE']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'CASCADE']
        );
    }

    /**
     * Add acme_coll_on_deliv_short_label foreign keys.
     */
    private function addAcmeCollOnDelivShortLabelForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('acme_coll_on_deliv_short_label');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_integration_transport'),
            ['transport_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'CASCADE']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'CASCADE']
        );
    }

    /**
     * Add oro_integration_transport foreign keys.
     */
    private function addOroIntegrationTransportForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('oro_integration_transport');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_dictionary_country'),
            ['ups_country_code'],
            ['iso2_code'],
            ['onUpdate' => null, 'onDelete' => null]
        );
    }
}