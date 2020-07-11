<?php

/**
 * Created by Phalms Module Generator.
 *
 * module tahun ajaran
 *
 * @package presensi
 * @author  dwiagus
 * @link    https://presensi.pw
 * @date:   2020-07-09
 * @time:   01:07:18
 * @license MIT
 */
namespace Modules\Tahunajaran\Plugin;
use Phalcon\Db\Column;
use Phalcon\Db\Index;
class Publish extends \Phalcon\Mvc\User\Component
{
    function __construct($table)
    {
        $this->table    = $table;
    }

    public function up()
    {
        $arr_column = array(
            new Column("id", array(
                "type"  => Column::TYPE_INTEGER,
                "size"  => 11,
                "notNull"       => true,
                "autoIncrement" => true,
            ))
        );

        $arr_column[] = new Column('tahun', array(
	"type" => Column::TYPE_VARCHAR,
	"size" => 10,
	"notNull" => false,
	));
	$arr_column[] = new Column('status', array(
	"type" => Column::TYPE_VARCHAR,
	"size" => 11,
	"notNull" => false,
	));
	

        $arr_column[] = new Column("created", array(
            "type"    => Column::TYPE_TIMESTAMP,
            "size"    => 17,
            "notNull" => true,
        ));

        $arr_column[] = new Column("updated", array(
            "type"    => Column::TYPE_TIMESTAMP,
            "size"    => 17,
            "notNull" => false,
        ));

        try{
            $this->db->createTable(strtolower($this->table), null, array(
                "columns" => $arr_column,
                "indexes" => array( new Index("PRIMARY", array("id")))
	"indexes" => array( new Index("PRIMARY", array("id")))
	
            ));
            $result = "Created Table $this->table in Database";
        }catch (\Exception $e){
            $result = $e->getMessage();
        }
        return $result;
    }

    public function down()
    {
        return $this->db->dropTable('tahunajaran');
    }
}