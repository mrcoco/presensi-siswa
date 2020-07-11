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
namespace Modules\Tahunajaran\Models;
use \Phalcon\Mvc\Model\Behavior\Timestampable;
class Tahunajaran extends \Phalcon\Mvc\Model
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
	* @Column(type='string',* length=='10',nullable=false)
	*
	*/
	public $tahun;
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