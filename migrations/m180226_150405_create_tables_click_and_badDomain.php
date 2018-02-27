<?php

use yii\db\Migration;

/**
 * Class m180226_150405_create_tables_click_and_badDomain
 */
class m180226_150405_create_tables_click_and_badDomain extends Migration
{
    private $click = '{{%click}}';
    private $bad_domain = '{{%bad_domain}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->bad_domain, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createTable($this->click, [
            'id' => $this->string(25)->notNull(),
            'ua' => $this->string()->notNull(),
            'ip' => $this->string(25)->notNull(),
            'ref' => $this->string(),
            'param1' => $this->string(),
            'param2' => $this->string(),
            'error' => $this->integer(),
            'bad_domain' => $this->integer(),
        ], $tableOptions);

        $this->addPrimaryKey('click_pk', $this->click, ['id']);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->click);
        $this->dropTable($this->bad_domain);
    }
}
