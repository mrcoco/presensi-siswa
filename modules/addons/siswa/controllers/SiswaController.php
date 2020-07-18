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

namespace Modules\Siswa\Controllers;
use Modules\History\Models\History;
use Modules\Kelas\Models\Kelas;
use Modules\Siswa\Models\Siswa;
use Modules\Frontend\Controllers\ControllerBase;
use Modules\Siswa\Plugin\Batch;
use Modules\Siswa\Plugin\Publish;
use Modules\Tahunajaran\Models\Tahunajaran;
use Modules\User\Models\Users;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SiswaController extends ControllerBase
{
    /**
     * @var \Phalcon\Mvc\Model|void
     */
    private $tahun;

    public function initialize()
    {
        $this->assets
            ->collection('footer')
            ->setTargetPath("themes/admin/assets/js/combined-siswa.js")
            ->setTargetUri("themes/admin/assets/js/combined-siswa.js")
            ->join(true)
            ->addJs($this->config->application->addonsDir."siswa/views/js/js.js")
            ->addFilter(new \Phalcon\Assets\Filters\Jsmin());
        $this->tahun = Tahunajaran::findFirst("status='1'");
    }

    public function indexAction()
    {
        $this->view->setVar('kelas' ,Kelas::find("status=1"));
        $this->view->pick("index");
    }

    public function searchAction()
    {
        $key = $this->request->getQuery('q');
        $this->view->disable();
        $siswa = Siswa::find([
            "conditions" => "nama LIKE ?1",
            "bind" => [
                1 => "%".$key."%"
            ]
        ]);
        $result = array();
        if($siswa)
        {
            foreach ($siswa as $item)
            {
                $result[] = array(
                    'id'    => $item->id,
                    'nama'  => $item->nama,
                    'nisn'  => $item->nisn,
                    'kelas' => $item->kelas,
                    'name'  => $item->nama,
                );
            }
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent($result);
        return $response->send();
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
            $arProp['conditions'] = "nama LIKE ?1 OR nisn LIKE ?1 OR kelas LIKE ?1";
            $arProp['bind'] = array(
                1 => "%".$searchPhrase."%"
            );
        }
        $qryTotal = Siswa::find($arProp);
        $rowCount = $rowCount < 0 ? $qryTotal->count() : $rowCount;
        $arProp['order'] = "created DESC";
        $arProp['limit'] = $rowCount;
        $arProp['offset'] = (($current*$rowCount)-$rowCount);
        if($sort){
            foreach ($sort as $k => $v) {
                $arProp['order'] = $k.' '.$v;
            }
        }
        $qry = Siswa::find($arProp);
        $arQry = array();
        $no =1;
        foreach ($qry as $item){
            $arQry[] = array(
                'no'    => $no,
                'id'    => $item->id,
                'nama'  => $item->nama,
	            'nisn'  => $item->nisn,
	            'kelas' => $item->kelas,
                'sex'   => $item->sex,
	            'pass'  => $item->pass,
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

    public function importAction()
    {
        $this->view->pick("import");
    }

    public function uploadAction()
    {
        $this->view->disable();
        if($this->request->hasFiles())
        {
            //$location = $this->config->application->uploadDir;
            $file = $this->config->application->uploadDir."data.xlsx";
            foreach ($this->request->getUploadedFiles() as $uploadedFile) {
                $uploadedFile->moveTo($file);
            }
            $this->batchInsert($file);

            $alert = "sukses";
            $msg = "Import Siswa Success";

        }else{
            $alert = "error";
            $msg = "Import Siswa Gagal";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => "excel",'alert' => $alert, 'msg' => $msg, 'files' => $_FILES ));
        return $response->send();
    }



    public function batchAction()
    {
        $siswa = Siswa::find();
        $sql ="";
        foreach ($siswa as $item)
        {
            $sql .= "INSERT INTO `users` (`name`,`profilesId`,`email`,`password`,`banned`,`suspended`,`active`) VALUES ('".$item->nama."','2','".$item->nisn."','".$this->security->hash($item->pass)."','N','N','Y');<br>";
        }
        echo $sql;
    }

    public function createAction()
    {
        $this->view->disable();
        $siswa = Siswa::findFirst([
            'conditions' => 'nisn = ?1',
            'bind' => [
                1 => $this->request->getPost('nisn')
            ]
        ]);
        $msg="";
        if(!$siswa)
        {
            $data = new Siswa();
            $data->nama = $this->request->getPost('nama');
            $data->nisn = $this->request->getPost('nisn');
            $data->kelas = $this->request->getPost('kelas');
            $data->sex  = $this->request->getPost('sex');
            if(empty($this->request->getPost('pass')))
            {
                $password = $this->request->getPost('nisn');
            }else{
                $password = $this->request->getPost('pass');
            }

            $data->pass = $password;
            if($data->save()){
                $user = new Users([
                    'name'          => $this->request->getPost('nama', 'striptags'),
                    'profilesId'    => 2,
                    'email'         => $this->request->getPost('nisn'),
                    'password'      => $this->security->hash($password),
                    'banned'        => 'N',
                    'suspended'     => 'N',
                    'active'        => 'Y'
                ]);
                $user->save();
                $this->historyKelas();
                $alert = "sukses";
                $msg .= "Created Success ";
            }else{
                $alert = "error";
                $msg .= "Created failed";
            }
        }else{
            $alert = "error";
            $msg .= "Created failed nisn exsist ".$siswa->nama;
        }

        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost("nama"),'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    public function editAction()
    {
        $this->view->disable();
        $data = Siswa::findFirst($this->request->getPost('hidden_id'));
        $data->nama = $this->request->getPost('nama');
	    $data->nisn = $this->request->getPost('nisn');
	    $data->kelas = $this->request->getPost('kelas');
        $data->sex  = $this->request->getPost('sex');
        if(!empty($this->request->getPost('pass')))
        {
            $password = $this->request->getPost('nisn');
            $data->pass = $password;
        }

        if (!$data->save()) {
            foreach ($data->getMessages() as $message) {
                $alert = "error";
                $msg .= $message." ";
            }
        }else{
            $this->historyKelas();
            $alert = "sukses";
            $msg .= "page was created successfully";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost("nama"),'alert' => $alert, 'msg' => $msg ));
        return $response->send();

    }

    public function getAction()
    {
        $data = Siswa::findFirst($this->request->getQuery('id'));
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent($data->toArray());
        return $response->send();
    }

    public function deleteAction($id)
    {
        $this->view->disable();
        $data   = Siswa::findFirstById($id);

        if (!$data->delete()) {
            $alert  = "error";
            $msg    = $data->getMessages();
        } else {
            $alert  = "sukses";
            $msg    = "Siswa was deleted ";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $id,'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    public function publishAction()
    {
        $publish = new Publish("siswa");
        $publish->up();
        echo "sukses";
    }

    public function unpublishAction()
    {
        $publish = new Publish("siswa");
        $publish->down();
        echo "sukses";
    }

    public function historyKelas()
    {
        if (!empty($this->request->getPost('kelas'))) {
            $history = new History([
                'nama' => $this->request->getPost('nama', 'striptags'),
                'nisn' => $this->request->getPost('nisn'),
                'kelas' => $this->request->getPost('kelas'),
                'sex' => $this->request->getPost('sex'),
                'tahun' => $this->tahun->tahun
            ]);
            $history->save();
        }
    }

    /**
     * @param $file
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function batchInsert($file)
    {
        $reader = IOFactory::createReaderForFile($file);
        $reader->setReadDataOnly(true);
        $sheet = $reader->load($file);
        $excel = $sheet->getActiveSheet()->toArray();
        $sql = [];
        $his =[];
        $user = [];
        for ($i = 1; $i < count($excel); $i++) {
            $no = $excel[$i][0];
            $nisn = $excel[$i][1];
            $nama = $excel[$i][2];
            $sex = $excel[$i][3];
            $kelas = $excel[$i][4];
            $pass = $this->security->hash($nisn);
            $sql[] = [$nisn, $nama, $sex, $kelas, $nisn];
            $his[] = [$nama,$nisn,  $sex, $kelas, $this->tahun->tahun];
            $user[] = [$nama,'2',$nisn,$pass, 'N', 'N', 'Y'];
        }

        $siswa = new Batch("siswa");
        $siswa->setRows(["nisn", "nama", "sex", "kelas", "pass"])->setValues($sql)->insert();
        $history = new Batch("history");
        $history->setRows(["nama","nisn", "sex", "kelas", "tahun"])->setValues($his)->insert();
        $users = new Batch("users");
        $users->setRows(['name','profilesId','email','password','banned', 'suspended','active' ])->setValues($user)->insert();
    }
}