<?php

/**
 * Created by Phalms Module Generator.
 *
 * Module dat siswa
 *
 * @package 
 * @author  dwiagus
 * @link    http://dwiagus.pw
 * @date:   2020-07-07
 * @time:   11:07:44
 * @license MIT
 */
namespace Modules\Siswa\Plugin;
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

        $arr_column[] = new Column('nama', array(
        "type" => Column::TYPE_VARCHAR,
        "size" => 255,
        "notNull" => false,
        ));

        $arr_column[] = new Column('nisn', array(
        "type" => Column::TYPE_VARCHAR,
        "size" => 50,
        "notNull" => false,
        ));

        $arr_column[] = new Column('kelas', array(
        "type" => Column::TYPE_VARCHAR,
        "size" => 10,
        "notNull" => false,
        ));

        $arr_column[] = new Column('sex', array(
            "type" => Column::TYPE_VARCHAR,
            "size" => 10,
            "notNull" => false,
        ));

        $arr_column[] = new Column('pass', array(
        "type" => Column::TYPE_VARCHAR,
        "size" => 255,
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
            ));
            $result = "Created Table $this->table in Database";
        }catch (\Exception $e){
            $result = $e->getMessage();
        }
        return $result;
    }

    public function down()
    {
        return $this->db->dropTable('siswa');
    }
}