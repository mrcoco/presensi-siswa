<?php
/**
 * Created by Phalms Module Generator.
 *
 * module managemen kelas
 *
 * @package presensi
 * @author  dwiagus
 * @link    https://dwiagus.pw
 * @date:   2020-07-09
 * @time:   00:07:18
 * @license MIT
 */
namespace Modules\Kelas\Models;
use \Phalcon\Mvc\Model\Behavior\Timestampable;
class Kelas extends \Phalcon\Mvc\Model
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
	* @Column(type='string',* length=='11',nullable=false)
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