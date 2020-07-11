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
namespace Modules\Presensi\Models;
use Modules\Siswa\Models\Siswa;
use \Phalcon\Mvc\Model\Behavior\Timestampable;
class Presensi extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
	*
	* @var integer
	* @Column(type='integer',* length=='11',nullable=false)
	*
	*/
	public $siswa_id;
	/**
	*
	* @var string
	* @Column(type='string',* length=='50',nullable=false)
	*
	*/
	public $nisn;

    /**
     *
     * @var string
     * @Column(type='string',* length=='50',nullable=false)
     *
     */
    public $kelas;

    /**
     *
     * @var string
     * @Column(type='string',* length=='255',nullable=false)
     *
     */
    public $tahun_ajaran;
    /**
	*
	* @var string
	* @Column(type='string',* length=='0',nullable=false)
	*
	*/
	public $tanggal;
	/**
	*
	* @var string
	* @Column(type='string',* length=='0',nullable=false)
	*
	*/
	public $jam_masuk;
	/**
	*
	* @var string
	* @Column(type='string',* length=='0',nullable=false)
	*
	*/
	public $jam_keluar;
	/**
	*
	* @var string
	* @Column(type='string',* length=='255',nullable=false)
	*
	*/
	public $foto_masuk;
	/**
	*
	* @var string
	* @Column(type='string',* length=='255',nullable=false)
	*
	*/
	public $foto_keluar;
	/**
	*
	* @var integer
	* @Column(type='integer',* length=='11',nullable=false)
	*
	*/
	public $sesi;

    /**
     *
     * @var integer
     * @Column(type='integer',* length=='11',nullable=false)
     *
     */
    public $status;
	

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $created;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updated;

    public function initialize()
    {
        $this->belongsTo(
            'siswa_id',
            'Modules\Siswa\Models\Siswa',
            'id',['alias' => 'siswa']
        );
        $this->addBehavior(
            new Timestampable(
                [
                    "beforeValidationOnCreate" => [
                        "field"  => "created",
                        "format" => "Y-m-d H:i:s",
                    ],
                    "beforeValidationUpdate" => [
                        "field"  => "updated",
                        "format" => "Y-m-d H:i:s",
                    ],
                ]
            )
        );
    }
}