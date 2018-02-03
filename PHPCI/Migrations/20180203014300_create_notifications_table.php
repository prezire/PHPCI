<?php
use Phinx\Migration\AbstractMigration;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
final class CreateNotificationsTable extends AbstractMigration
{
  /**
   * Table name.
   * @var string
   */
  private $tblName;

  /**
   * Table instance.
   * @var \Phinx\Db\Table
   */
  
  private $tbl;

  /**
   * [__construct description]
   * @param [type]               $version [description]
   * @param \Symfony\Component\Console\Output\InputInterface|null  $input
   * @param \Symfony\Component\Console\Output\OutputInterface|null $output
   */
  public function __construct
  (
    $version,
    InputInterface $input = null,
    OutputInterface $output = null
  )
  {
    parent::__construct($version, $input, $output);
    $this->tblName = 'notifications';
    $tbl = $this->table($this->tblName);
  }

  /**
   * Convenience method.
   * @param  string $name
   * @param  string $type
   * @param  array  $params
   * @return null
   */
  private function column($name, $type, $params = array())
  {
    if(!$this->tbl->hasColumn($name))
      $this->tbl->addColumn($name, $type, $params);
  }

  public function up()
  {
    if(!$this->hasTable($this->tblName))
    {
      $this->tbl->create();
      $this->column('title', 'string');
      $this->column('body', 'string', array('limit' => 250));
      $this->column('is_read', 'boolean', array('default' => false));
      $this->column('created_on', 'datetime');
      $this->column('updated_on', 'datetime');
      $this->column('project_id', 'integer');
      $this->tbl->addForeignKey
      (
        'project_id',
        'projects',
        'id',
        array('delete'=> 'RESTRICT', 'update' => 'CASCADE')
      );
      $tbl->save();
    }
  }

  public function down()
  {
    if($this->hasTable($this->tblName))
    {
      $this->tbl->dropForeignKey('project_id');
      $this->tbl->dropTable($this->tblName);
    }
  }
}
