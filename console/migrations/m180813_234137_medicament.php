<?php

use yii\db\Migration;

/**
 * Class m180813_234137_medicament
 */
class m180813_234137_medicament extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create medicament_name table
        $this->createTable('{{%medicament_name}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

        // Create unique constraint for medicament_name
        $this->createIndex('idx_unique_medicament_name',
            '{{%medicament_name}}', 
            ['name'], 
            true
        );

        // Create medicament_availability table
        $this->createTable('{{%medicament_availability}}', [
            'id' => $this->primaryKey(),
            'name_id' => $this->integer()->notNull(),
            'expiration_date' => $this->dateTime()->notNull(),
            'quantity' => $this->integer()->notNull()
        ]);

        // Add foreign key for table `medicament_availability`
        // Don't describe on delete and on update actions
        // We can't delete row from demicament_name table until we have any records 
        // in availability table
        $this->addForeignKey(
            'fk-name_id-medicament_name',
            '{{%medicament_availability}}',
            'name_id',
            '{{%medicament_name}}',
            'id'
        );

        // Create unique constraint for medicament_availability's multiple columns
        $this->createIndex('idx_unique_medicament_availability',
            '{{%medicament_availability}}', 
            ['name_id', 'expiration_date'], 
            true
        );

        // Create sickness table
        $this->createTable('{{%sickness}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

        // Create unique constraint for sickness' name
        $this->createIndex('idx_unique_sickness_name',
            '{{%sickness}}', 
            ['name'], 
            true
        );

        // Create junction table for many-to-many sickness' and medicament relation
        $this->createTable('{{%medicament_sickness}}', [
            'medicament_id' => $this->integer(),
            'sickness_id' => $this->integer(),
            'PRIMARY KEY(medicament_id, sickness_id)'
        ]);
        
        // Create foreign keys for junction table
        $this->addForeignKey(
            'fk-sickness_id-sickness_name',
            '{{%medicament_sickness}}',
            'sickness_id',
            '{{%sickness}}',
            'id'
        );

        $this->addForeignKey(
            'fk-medicament_id-medicament_name',
            '{{%medicament_sickness}}',
            'medicament_id',
            '{{%medicament_name}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%medicament_name}}');
        $this->dropTable('{{%medicament_availability}}');
        $this->dropTable('{{%sickness}}');
        $this->dropTable('{{%medicament_sickness}}');
    }
}
