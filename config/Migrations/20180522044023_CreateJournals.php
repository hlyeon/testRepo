<?php
use Migrations\AbstractMigration;

class CreateJournals extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('journals');
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('loginT', 'time', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('openT', 'time', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('closeT', 'time', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('logoutT', 'time', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('content', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('comment', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addForeignKey('user_id', 'users', 'id');
        $table->create();
    }
}
