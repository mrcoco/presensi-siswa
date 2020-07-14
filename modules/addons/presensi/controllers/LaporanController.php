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
use Modules\Presensi\Plugin\Base64Url;
use Modules\Presensi\Plugin\Helper;
use Modules\Tahunajaran\Models\Tahunajaran;
use Modules\Webconfig\Models\Webconfig;
use Phalcon\Assets\Filters\Jsmin;
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
    private $terlambat;
    private $pulangawal_normal;
    private $pulangawal_jumat;

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

        foreach (Webconfig::find()->toArray() as $k => $v) {
            if($v['name'] == 'jam_terlambat'){
                $this->terlambat = $v['content'];
            }
            if($v['name'] == 'jam_pulang_awal_jumat'){
                $this->pulangawal_jumat = $v['content'];
            }
            if($v['name'] == 'jam_pulang_awal_normal'){
                $this->pulangawal_normal = $v['content'];
            }
        }
    }

    public function indexAction()
    {

    }

    public function search_harianAction()
    {
        if ($this->request->isPost() == true)
        {
            $kelas = $this->request->getPost("kelas");
            $tahun = $this->request->getPost("tahun_ajaran");
            $tanggal    = $this->request->getPost("tanggal");
            $mode       = $this->request->getPost("mode");
            $arr = $this->presensiHarian($mode, $kelas, $tahun, $tanggal);
            $this->view->setRenderLevel(
                View::LEVEL_ACTION_VIEW
            );
            $this->view->setVar('tanggal', date('d M Y',strtotime($tanggal)));
            $this->view->setVar('url_print',Base64Url::encode($tahun."/".$tanggal."/".$mode."/".$kelas));
            $this->view->setVar('terlambat',$this->terlambat);
            $this->view->setVar('pulangawal_jumat', $this->pulangawal_jumat);
            $this->view->setVar('pulangawal_normal',$this->pulangawal_normal);
            $this->view->setVar('arr',$arr);

            if($mode == 0)
            {
                $this->view->pick('laporan/rekap_normal_harian');
            }else{
                $this->view->pick('laporan/rekap_sesi_harian');
            }
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

        $arr = $this->presensiBulanan($mode, $kelas, $tahun, $bulan);

        $work = $this->workBulanan($bulan);
        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );
        $this->view->setVar('url_print',Base64Url::encode($tahun."/".$bulan."/".$mode."/".$kelas));
        $this->view->setVar('terlambat',$this->terlambat);
        $this->view->setVar('pulangawal_jumat', $this->pulangawal_jumat);
        $this->view->setVar('pulangawal_normal',$this->pulangawal_normal);
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


    public function harianAction()
    {
        $this->view->setVar('kelas',$this->kelas);
        $this->view->setVar('tahun',$this->tahun);
        $this->view->pick("laporan/index_harian");
    }

    public function bulananAction()
    {
        $this->view->setVar('kelas',$this->kelas);
        $this->view->setVar('tahun',$this->tahun);
        $this->view->pick("laporan/index_bulanan");
    }

    public function cetak_bulananAction()
    {
        $geturl = Base64Url::decode($this->request->getQuery('url'));
        list($tahun,$bulan,$mode,$kelas) = explode("/",$geturl);
        $arr = $this->presensiBulanan($mode, $kelas, $tahun, $bulan);
        $work = $this->workBulanan($bulan);
        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );
        $this->view->setVar('terlambat',$this->terlambat);
        $this->view->setVar('pulangawal_jumat', $this->pulangawal_jumat);
        $this->view->setVar('pulangawal_normal',$this->pulangawal_normal);
        $this->view->setVar('count_work',count($work));
        $this->view->setVar('work',$work);
        $this->view->setVar('arr',$arr);
        if($mode == 0){
            $this->view->pick("laporan/cetak_normal_bulanan");
        }else{
            $this->view->pick("laporan/cetak_sesi_bulanan");
        }

    }

    public function cetak_harianAction()
    {
        $geturl = Base64Url::decode($this->request->getQuery('url'));
        list($tahun,$tanggal,$mode,$kelas) = explode("/",$geturl);
        $arr = $this->presensiHarian($mode, $kelas, $tahun, $tanggal);
        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );
        $this->view->setVar('tanggal', date('d M Y',strtotime($tanggal)));
        $this->view->setVar('terlambat',$this->terlambat);
        $this->view->setVar('pulangawal_jumat', $this->pulangawal_jumat);
        $this->view->setVar('pulangawal_normal',$this->pulangawal_normal);
        $this->view->setVar('arr',$arr);
        if($mode == 0){
            $this->view->pick("laporan/cetak_normal_harian");
        }else{
            $this->view->pick("laporan/cetak_sesi_harian");
        }
    }

    /**
     * @param $mode
     * @param $kelas
     * @param $tahun
     * @param $bulan
     * @return array
     */
    public function presensiBulanan($mode, $kelas, $tahun, $bulan)
    {
        if ($mode == 0) {
            $isMode = 'AND sesi=0';
        } else {
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
        foreach ($history as $siswa) {
            $arr[] = [
                'nisn' => $siswa->nisn,
                'nama' => $siswa->nama,
                'sex' => $siswa->sex,
                'presensi' => $siswa->getPresensi(
                    ['conditions' => "kelas = '{$kelas}' AND tahun_ajaran='{$tahun}' AND DATE_FORMAT(tanggal,'%m-%Y') = '{$bulan}' " . $isMode]),
            ];
        }
        return $arr;
    }

    /**
     * @param $bulan
     * @return array
     */
    public function workBulanan($bulan)
    {
        $start = Helper::firstday($bulan);
        $end = Helper::lastDay($bulan);
        return Helper::workingDay($start, $end);
    }

    /**
     * @param $mode
     * @param $kelas
     * @param $tahun
     * @param $tanggal
     * @return array
     */
    public function presensiHarian($mode, $kelas, $tahun, $tanggal)
    {
        if ($mode == 0) {
            $isMode = 'AND sesi=0';
        } else {
            $isMode = 'AND sesi <> 0';
        }
        $presensi = History::find([
            'conditions' => 'kelas= ?1 AND tahun= ?2',
            'bind' => [
                1 => $kelas,
                2 => $tahun,
            ]
        ]);
        $arr = array();
        foreach ($presensi as $siswa) {
            $arr[] = [
                'nisn' => $siswa->nisn,
                'nama' => $siswa->nama,
                'sex' => $siswa->sex,
                'presensi' => $siswa->getPresensi(
                    ['conditions' => "kelas = '{$kelas}' AND tahun_ajaran='{$tahun}' AND tanggal = '{$tanggal}' " . $isMode]),
            ];
        }
        return $arr;
    }
}