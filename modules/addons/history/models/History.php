<?php
/**
 * Created by Phalms Module Generator.
 *
 * module history kelas
 *
 * @package presensi
 * @author  dwiagus
 * @link    http://dwiagus.pw
 * @date:   2020-07-11
 * @time:   10:07:57
 * @license MIT
 */
namespace Modules\History\Models;
use \Phalcon\Mvc\Model\Behavior\Timestampable;
class History extends \Phalcon\Mvc\Model
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
	* @var string
	* @Column(type='string',* length=='255',nullable=false)
	*
	*/
	public $nama;
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
	* @Column(type='string',* length=='10',nullable=false)
	*
	*/
	public $sex;
	/**
	*
	* @var string
	* @Column(type='string',* length=='20',nullable=false)
	*
	*/
	public $kelas;
	/**
	*
	* @var string
	* @Column(type='string',* length=='50',nullable=false)
	*
	*/
	public $tahun;
	

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
        $this->hasMany('nisn', 'Modules\Presensi\Models\Presensi', 'nisn', [
            'alias' => 'presensi',
        ]);
    }
}