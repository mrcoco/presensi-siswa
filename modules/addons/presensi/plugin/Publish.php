<?php

/**
 * Created by Phalms Module Generator.
 *
 * module data presensi siswa
 *
 * @package presensi
 * @author  Dwi Agus
 * @link    http://dwiagus.pw
 * @date:   2020-07-07
 * @time:   14:07:31
 * @license MIT
 */
namespace Modules\Presensi\Plugin;
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

        $arr_column[] = new Column('siswa_id', array(
        "type" => Column::TYPE_INTEGER,
        "size" => 11,
        "notNull" => false,
        ));
        $arr_column[] = new Column('nisn', array(
        "type" => Column::TYPE_VARCHAR,
        "size" => 50,
        "notNull" => false,
        ));
        $arr_column[] = new Column('kelas', array(
            "type" => Column::TYPE_VARCHAR,
            "size" => 50,
            "notNull" => false,
        ));
        $arr_column[] = new Column('tahun_ajaran', array(
            "type" => Column::TYPE_VARCHAR,
            "size" => 25,
            "notNull" => false,
        ));
        $arr_column[] = new Column('tanggal', array(
        "type" => Column::TYPE_DATE,
        "size" => 0,
        "notNull" => false,
        ));
        $arr_column[] = new Column('jam_masuk', array(
        "type" => Column::TYPE_DATETIME,
        "size" => 0,
        "notNull" => false,
        ));
        $arr_column[] = new Column('jam_keluar', array(
        "type" => Column::TYPE_DATETIME,
        "size" => 0,
        "notNull" => false,
        ));
        $arr_column[] = new Column('foto_masuk', array(
        "type" => Column::TYPE_VARCHAR,
        "size" => 255,
        "notNull" => false,
        ));
        $arr_column[] = new Column('foto_keluar', array(
        "type" => Column::TYPE_VARCHAR,
        "size" => 255,
        "notNull" => false,
        ));
        $arr_column[] = new Column('sesi', array(
        "type" => Column::TYPE_INTEGER,
        "size" => 11,
        "notNull" => false,
        ));

        $arr_column[] = new Column('status', array(
            "type" => Column::TYPE_INTEGER,
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
	
            ));
            $result = "Created Table $this->table in Database";
        }catch (\Exception $e){
            $result = $e->getMessage();
        }
        return $result;
    }

    public function down()
    {
        return $this->db->dropTable('presensi');
    }
}