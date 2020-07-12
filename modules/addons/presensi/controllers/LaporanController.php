<?php
/**
 * presensi-siswa
 * LaporanController.php
 * Author: DwiAgus
 * Email : dwiagus@uny.ac.id
 * Date  : 10/07/2020
 * Time  : 20:09
 */

namespace Modules\Presensi\Controllers;


use Modules\Frontend\Controllers\ControllerBase;
use Modules\History\Models\History;
use Modules\Kelas\Models\Kelas;
use Modules\Presensi\Models\Presensi;
use Modules\Presensi\Plugin\Helper;
use Modules\Tahunajaran\Models\Tahunajaran;
use Modules\Webconfig\Models\Webconfig;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Http\Response;
use Phalcon\Mvc\Model\ResultsetInterface;
use Phalcon\Mvc\View;

class LaporanController extends ControllerBase
{
    /**
     * @var ResultsetInterface|void
     */
    private $tahun;
    /**
     * @var ResultsetInterface|void
     */
    private $kelas;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->tahun = Tahunajaran::find();
        $this->kelas = Kelas::find("status='1'");
        $this->assets
            ->collection('footer')
            ->setTargetPath("themes/admin/assets/js/combined-presensi-laporan.js")
            ->setTargetUri("themes/admin/assets/js/combined-presensi-laporan.js")
            ->join(true)
            ->addJs($this->config->application->addonsDir."presensi/views/js/laporan.js")
            ->addFilter(new Jsmin());
    }

    public function indexAction()
    {

    }

    public function search_harianAction()
    {
        $this->view->disable();
        if ($this->request->isPost() == true)
        {
            $kelas = $this->request->getPost("kelas");
            $tahun = $this->request->getPost("tahun_ajaran");
            $tanggal = $this->request->getPost("tanggal");
            $presensi = History::find([
                'conditions' => 'kelas= ?1 AND tahun= ?2',
                'bind' => [
                    1 => $kelas,
                    2 => $tahun,
                ]
            ]);
            $arr = array();
            foreach ($presensi as $siswa)
            {
                $arr[] = [
                    'nisn' => $siswa->nisn,
                    'nama' => $siswa->nama,
                    'sex'  => $siswa->sex,
                    'presensi' => $siswa->getPresensi(
                        ['conditions' => "kelas = '{$kelas}' AND tahun_ajaran='{$tahun}' AND tanggal = '{$tanggal}' "]),
                ];
            }
//            $response = new Response();
//            $response->setContentType('application/json', 'UTF-8');
//            $response->setJsonContent($presensi);
//            return $response->send();
            echo $this->harianSesi($arr);
        }
    }

    public function search_bulananAction()
    {
        $kelas = $this->request->getPost('kelas');
        $tahun = $this->request->getPost('tahun_ajaran');
        if(empty($this->request->getPost('bulan')))
        {
            $bulan = date('m-Y');
        }else{
            $bulan = $this->request->getPost('bulan');
        }

        $mode  = $this->request->getPost('mode');
        if($mode == 0)
        {
            $isMode = 'AND sesi=0';
        }else{
            $isMode = 'AND sesi <> 0';
        }
        $history = History::find([
            'conditions' => "kelas= ?1 AND tahun= ?2",
            'bind' => [
                1 => $kelas,
                2 => $tahun
            ]
        ]);
        $arr = array();
        foreach ($history as $siswa)
        {
            $arr[] = [
                'nisn' => $siswa->nisn,
                'nama' => $siswa->nama,
                'sex'  => $siswa->sex,
                'presensi' => $siswa->getPresensi(
                    ['conditions' => "kelas = '{$kelas}' AND tahun_ajaran='{$tahun}' AND DATE_FORMAT(tanggal,'%m-%Y') = '{$bulan}' ".$isMode]),
            ];
        }
        $webconfig = Webconfig::find()->toArray();
        $start = Helper::firstday($bulan);
        $end = Helper::lastDay($bulan);
        $work = Helper::workingDay($start,$end);
        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );
        $this->view->setVar('webconfig',$webconfig);
        $this->view->setVar('count_work',count($work));
        $this->view->setVar('work',$work);
        $this->view->setVar('arr',$arr);
        if($mode == 0)
        {
            $this->view->pick('laporan/rekap_normal_bulanan');
        }else{
            $this->view->pick('laporan/rekap_sesi_bulanan');
        }

    }

    public function harianSesi($arr)
    {
        $html = "";
        $html .= "<table id=\"presensi-harian\" class=\"table table-condensed table-hover table-striped\">";
        $html .= "<thead>";
        $html .= "<tr>";
        $html .= "<th>NAMA</th>";
        $html .= "<th>NIS</th>";
        $html .= "<th>JK</th>";
        $html .= "<th>SESI 1</th>";
        $html .= "<th>SESI 2</th>";
        $html .= "<th>SESI 3</th>";
        $html .= "<th>SESI 4</th>";
        $html .= "<th>SESI 5</th>";
        $html .= "<th>I</th>";
        $html .= "<th>S</th>";
        $html .= "<th>A</th>";
        $html .= "<th>KET</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        foreach ($arr as $item) {
            $html .= "<tr>";
            $html .= "<td>" . $item['nama'] . "</td>";
            $html .= "<td>" . $item['nisn'] . "</td>";
            $html .= "<td>" . $item['sex'] . "</td>";
            $izin = 0;
            $sakit = 0;
            $hadir = 0;
            $sesi = [1,2,3,4,5];
            $arr_sesi = [];
            for($i=1; $i<=5; $i++)
            {
                $html .= "<td>";
                foreach ($item['presensi'] as $pres) {
                    if($pres->status == '1' || $pres->status == '2'){
                        if($pres->sesi == $i)
                        {
                            $html .= date('H:m:s',strtotime($pres->jam_masuk));
                            $arr_sesi[] = $i;
                        }
                    }
                    if($pres->status == '3')
                    {
                        $izin +=1;
                        //$html .="I";
                    }
                    if($pres->status == '4')
                    {
                        $sakit +=1;
                        //$html .="S";
                    }
                    $hadir +=1;
                }
                $html .= "</td>";
            }
            if($hadir == 0){
                $alpha = "A";
            }else{
                $alpha = "-";
            }
            if($izin !== 0){
                $iz = "I";
            }else{
                $iz = "-";
            }
            if($sakit !== 0)
            {
                $sk = "S";
            }else{
                $sk = "-";
            }
            $diff = array_diff($sesi,$arr_sesi);

            if(count($diff) !== 5){
                $kt = implode(",",$diff);
                $ket = "Tidak ikut sesi ".$kt;
            }else{
                $ket = "";
            }
            $html .= "<td>{$iz}</td>";
            $html .= "<td>{$sk}</td>";
            $html .= "<td>{$alpha}</td>";
            $html .= "<td>{$ket}</td>";
            $html .= "</tr>";
        }
        return $html;
    }

    public function bulananDatangPulang($arr,$bt)
    {

    }

    public function bulananSesi($arr, $bt)
    {
        $start = Helper::firstday($bt);
        $end = Helper::lastDay($bt);
        $work = Helper::workingDay($start,$end);
        $html = "";
        $html .= "<table id=\"presensi-bulanan\" class=\"table table-condensed table-hover table-striped\">";
        $html .= "<thead>";
        $html .= "<tr>";
        $html .= "<th rowspan='2' valign='top'>NAMA</th>";
        $html .= "<th rowspan='2' valign='top'>NIS</th>";
        $html .= "<th rowspan='2' valign='top'>JK</th>";
        $html .= "<th colspan='".count($work)."'>TANGGAL</th>";
        $html .= "<th colspan='3'>JUMLAH</th>";
        $html .= "<th rowspan='2' valign='top'>KET</th>";
        $html .= "</tr>";
        $html .= "<tr>";
        foreach ($work as $k => $item) {
            list($y,$m,$d) = explode("-",$item);
            $html .= "<th>".$d."</th>";
        }
        $html .= "<th rowspan='2'>I</th>";
        $html .= "<th rowspan='2'>S</th>";
        $html .= "<th rowspan='2'>A</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        foreach ($arr as $item) {
            $html .= "<tr>";
            $html .= "<td>".$item['nama']."</td>";
            $html .= "<td>".$item['nisn']."</td>";
            $html .= "<td>".$item['sex']."</td>";
            $izin = 0;
            $sakit= 0;
            $hadir= 0;
            foreach ($work as $k => $wk) {
                $html .= "<td>";
                foreach ($item['presensi'] as $pres) {
                    if ($pres->tanggal == $wk)
                    {
                        if($pres->status == '1' || $pres->status == '2'){
                            $html .= date('H:m:s',strtotime($pres->jam_masuk)) ."<br>";
                        }
                        if($pres->status == '3')
                        {
                            $izin +=1;
                            $html .="I";
                        }
                        if($pres->status == '4')
                        {
                            $sakit +=1;
                            $html .="S";
                        }
                        $hadir +=1;
                    }

                }
                $html .= "</td>";
            }
            $alpha= count($work)-$hadir;
            $html .= "<td>{$izin}</td>";
            $html .= "<td>{$sakit}</td>";
            $html .= "<td>{$alpha}</td>";
            $html .= "<td></td>";
            $html .= "</tr>";
        }
        $html .= "</tbody>";
        $html .="</table>";
        return $html;
    }

    public function harianAction()
    {
        $this->view->setVar('kelas',$this->kelas);
        $this->view->setVar('tahun',$this->tahun);
        $this->view->pick("laporan_harian");
    }

    public function bulananAction()
    {
        $this->view->setVar('kelas',$this->kelas);
        $this->view->setVar('tahun',$this->tahun);
        $this->view->pick("laporan/index_bulanan");
    }

    public function cetak_bulananAction()
    {

    }

    public function cetak_harianAction()
    {

    }
}