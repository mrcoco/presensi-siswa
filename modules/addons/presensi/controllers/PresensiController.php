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

namespace Modules\Presensi\Controllers;
use Modules\Presensi\Models\Presensi;
use Modules\Frontend\Controllers\ControllerBase;
use Modules\Presensi\Plugin\Publish;
use Modules\Tahunajaran\Models\Tahunajaran;

class PresensiController extends ControllerBase
{
    public function initialize()
    {
        $this->assets
            ->collection('footer')
            ->setTargetPath("themes/admin/assets/js/combined-presensi.js")
            ->setTargetUri("themes/admin/assets/js/combined-presensi.js")
            ->join(true)
            ->addJs($this->config->application->addonsDir."presensi/views/js/js.js")
            ->addFilter(new \Phalcon\Assets\Filters\Jsmin());

    }

    public function indexAction()
    {
        $this->view->pick("index");
    }

    public function listAction()
    {
        $this->view->disable();
        $arProp = array();
        $current = intval($this->request->getPost('current'));
        $rowCount = intval($this->request->getPost('rowCount'));
        $searchPhrase = $this->request->getPost('searchPhrase');
        $sort = $this->request->getPost('sort');
        if ($searchPhrase != '') {
            $arProp['conditions'] = "nisn LIKE ?1 OR tanggal LIKE ?1 OR siswa_id LIKE ?1";
            $arProp['bind'] = array(
                1 => "%".$searchPhrase."%"
            );
        }
        $qryTotal = Presensi::find($arProp);
        $rowCount = $rowCount < 0 ? $qryTotal->count() : $rowCount;
        $arProp['order'] = "created DESC";
        $arProp['limit'] = $rowCount;
        $arProp['offset'] = (($current*$rowCount)-$rowCount);
        if($sort){
            foreach ($sort as $k => $v) {
                $arProp['order'] = $k.' '.$v;
            }
        }
        $qry = Presensi::find($arProp);
        $arQry = array();
        $no =1;
        foreach ($qry as $item){
            $arQry[] = array(
                'no'    => $no,
                'id'    => $item->id,
                'siswa_id' => $item->siswa_id,
                'siswa_nama' => $item->siswa->nama,
                'nisn' => $item->nisn,
                'kelas' => $item->kelas,
                'tanggal' => $item->tanggal,
                'jam_masuk' => $item->jam_masuk,
                'jam_keluar' => $item->jam_keluar,
                'foto_masuk' => $item->foto_masuk,
                'foto_keluar' => $item->foto_keluar,
                'sesi' => $item->sesi,
	
                'created' => $item->created
            );
            $no++;
        }
        //$arQry = $qry->toArray();
        $data = array(
            'current'   => $current,
            'rowCount'  => $qry->count(),
            'rows'      => $arQry,
            'total'     => $qryTotal->count(),
            'filter'    => $arProp
        );
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent($data);
        return $response->send();
    }

    public function createAction()
    {
        $this->view->disable();
        $tahun = Tahunajaran::findFirst("status='1'");
        $data = new Presensi();
        $data->tahun_ajaran = $tahun->tahun;
        $data->siswa_id = $this->request->getPost('siswa_id');
        $data->nisn = $this->request->getPost('nisn');
        $data->kelas = $this->request->getPost('kelas');
        $data->tanggal = $this->request->getPost('tanggal');
        $data->jam_masuk = $this->request->getPost('jam_masuk');
        if($this->request->getPost('jam_keluar')){
            $data->jam_keluar = $this->request->getPost('jam_keluar');
        }
        $data->sesi = $this->request->getPost('sesi');
	    $data->status = '2';
        if($data->save()){
            $alert = "sukses";
            $msg .= "Edited Success ";
        }else{
            $alert = "error";
            $msg .= "Edited failed";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost("title"),'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    public function editAction()
    {
        $this->view->disable();
        $data = Presensi::findFirst($this->request->getPost('hidden_id'));
        $data->siswa_id = $this->request->getPost('siswa_id');
        $data->nisn = $this->request->getPost('nisn');
        $data->tanggal = $this->request->getPost('tanggal');
        $data->jam_masuk = trim($this->request->getPost('jam_masuk'));
        $data->jam_keluar = trim($this->request->getPost('jam_keluar'));
        //$data->foto_masuk = $this->request->getPost('foto_masuk');
        //$data->foto_keluar = $this->request->getPost('foto_keluar');
        $data->sesi = $this->request->getPost('sesi');

        if (!$data->save()) {
            foreach ($data->getMessages() as $message) {
                $alert = "error";
                $msg .= $message." ";
            }
        }else{
            $alert = "sukses";
            $msg .= "page was created successfully";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost("title"),'alert' => $alert, 'msg' => $msg ));
        return $response->send();

    }

    public function getAction()
    {
        $data = Presensi::findFirst($this->request->getQuery('id'));
        $result = array(
            'id'            => $data->id,
            'nisn'          => $data->nisn,
            'siswa_id'      => $data->siswa_id,
            'siswa_nama'    => $data->siswa->nama,
            'kelas'         => $data->siswa->kelas,
            'tanggal'       => $data->tanggal,
            'jam_masuk'     => $data->jam_masuk,
            'jam_keluar'    => $data->jam_keluar,
            'sesi'          => $data->sesi,
        );
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent($result);
        return $response->send();
    }

    public function deleteAction($id)
    {
        $this->view->disable();
        $data   = Presensi::findFirstById($id);

        if (!$data->delete()) {
            $alert  = "error";
            $msg    = $data->getMessages();
        } else {
            $alert  = "sukses";
            $msg    = "Presensi was deleted ";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $id,'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }


    public function publishAction()
    {
        $publish = new Publish("presensi");
        $publish->up();
        echo "succes";
    }

    public function unpublishAction()
    {
        $publish = new Publish("presensi");
        $publish->down();
        echo "succes";
    }
}