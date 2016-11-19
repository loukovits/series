<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AlterUserTableAddCollumnDeleted extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $users=$this->table('users');
        $users->addColumn('deleted', 'integer', array('limit' => MysqlAdapter::INT_TINY,'length'=>1,'default'=>0))
              ->addColumn('blocked', 'integer', array('limit' => MysqlAdapter::INT_TINY,'length'=>1,'default'=>0))
              ->save();
    }

    public function down(){
        $users=$this->table('users');
        $users->removeColumn('deleted')
              ->removeColumn('blocked');
    }
}
