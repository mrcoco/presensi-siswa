<?php
/**
 * htdocs
 * RiwayatController.php
 * Author: DwiAgus
 * Email : dwiagus@uny.ac.id
 * Date  : 14/07/2020
 * Time  : 23:08
 */

namespace Modules\Presensi\Controllers;


use Modules\Frontend\Controllers\ControllerBase;
use Modules\History\Models\History;
use Modules\Presensi\Plugin\Base64Url;
use Modules\Presensi\Plugin\Helper;
use Modules\Webconfig\Models\Webconfig;
use Phalcon\Mvc\View;

class RiwayatController extends ControllerBase
{


    /**
     * @var mixed|void
     */
    private $terlambat;
    /**
     * @var mixed|void
     */
    private $pulangawal_jumat;
    /**
     * @var mixed|void
     */
    private $pulangawal_normal;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->assets
            ->collection('footer')
            ->setTargetPath("themes/admin/assets/js/combined-riwayat-presensi.js")
            ->setTargetUri("themes/admin/assets/js/combined-riwayat-presensi.js")
            ->join(true)
            ->addJs($this->config->application->addonsDir."presensi/views/js/riwayat.js")
            ->addFilter(new \Phalcon\Assets\Filters\Jsmin());

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

    public function harianAction()
    {
        $this->view->pick("riwayat/index_harian");
    }

    public function bulananAction()
    {
        $this->view->pick("riwayat/index_bulanan");
    }

    public function search_bulananAction()
    {
        $mode   = $this->request->getPost('mode');
        $siswa  = $this->request->getPost('siswa_id');
        $bulan  = $this->request->getPost('bulan');
        $nisn   = $this->request->getPost('siswa_nisn');
        $arr = $this->personalBulanan($mode,$nisn,$bulan);

        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );
        $this->view->setVar('work',Helper::workBulanan($bulan));
        $this->view->setVar('url_print',Base64Url::encode($bulan."/".$mode."/".$nisn));
        $this->view->setVar('arr',$arr);
        if($mode == 0){
            $this->view->pick('riwayat/riwayat_normal_bulanan');
        }else{
            $this->view->pick('riwayat/riwayat_sesi_bulanan');
        }
    }

    public function search_harianAction()
    {
        $mode   = $this->request->getPost('mode');
        $siswa  = $this->request->getPost('siswa_id');
        $start  = $this->request->getPost('start');
        $end  = $this->request->getPost('end');
        $nisn   = $this->request->getPost('siswa_nisn');
        $arr = $this->personalHarian($mode,$nisn,$start,$end);
        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );
        $this->view->setVar('work',Helper::workingDay($start,$end));
        $this->view->setVar('url_print',Base64Url::encode($start."/".$end."/".$mode."/".$nisn));
        $this->view->setVar('arr',$arr);
        if($mode == 0){
            $this->view->pick('riwayat/riwayat_normal_harian');
        }else{
            $this->view->pick('riwayat/riwayat_sesi_harian');
        }
    }

    public function cetak_harianAction()
    {
        $geturl = Base64Url::decode($this->request->getQuery('url'));
        list($start,$end,$mode,$nisn) = explode("/",$geturl);
        $arr = $this->personalHarian($mode,$nisn,$start,$end);

        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );
        $this->view->setVar('work',Helper::workingDay($start,$end));
        $this->view->setVar('arr',$arr);
        if($mode == 0){
            $this->view->pick('riwayat/cetak_normal_harian');
        }else{
            $this->view->pick('riwayat/cetak_sesi_harian');
        }
    }

    public function cetak_bulananAction()
    {
        $geturl = Base64Url::decode($this->request->getQuery('url'));
        list($bulan,$mode,$nisn) = explode("/",$geturl);
        $arr = $this->personalBulanan($mode,$nisn,$bulan);

        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );
        $this->view->setVar('work',Helper::workBulanan($bulan));
        $this->view->setVar('arr',$arr);
        if($mode == 0){
            $this->view->pick('riwayat/cetak_normal_bulanan');
        }else{
            $this->view->pick('riwayat/cetak_sesi_bulanan');
        }
    }

    public function personalHarian($mode,$nisn,$start,$end)
    {
        if ($mode == 0) {
            $isMode = 'AND sesi=0';
        } else {
            $isMode = 'AND sesi <> 0';
        }
        $work = Helper::workingDay($start,$end);
        $siswa = History::findFirst([
            'conditions' => 'nisn= ?1',
            'bind' => [
                1 => $nisn,
            ]
        ]);
        $data = $siswa->getPresensi(
            ['conditions' => "(tanggal BETWEEN '{$start}' AND '{$end}') " . $isMode]);
        if($mode == 0){
            return $this->presensiNormalResult($work, $data, $siswa);
        }else{
            return $this->presensiSesiResult($work, $data, $siswa);
        }

    }

    public function personalBulanan($mode, $nisn, $bulan)
    {
        if ($mode == 0) {
            $isMode = 'AND sesi=0';
        } else {
            $isMode = 'AND sesi <> 0';
        }
        $work = Helper::workBulanan($bulan);
        $history = History::findFirst([
            'conditions' => "nisn= ?1",
            'bind' => [
                1 => $nisn,
            ]
        ]);

        $data = $history->getPresensi(
            ['conditions' => "DATE_FORMAT(tanggal,'%m-%Y') = '{$bulan}' " . $isMode]);
        if($mode == 0){
            $result = $this->presensiNormalResult($work, $data, $history);
        }else{
            $result = $this->presensiSesiResult($work, $data, $history);
            //$result = $data;
        }

        return $result;
    }

    /**
     * @param array $work
     * @param $data
     * @param $history
     * @return array
     * @throws \Exception
     */
    public function presensiNormalResult(array $work, $data, $history)
    {
        $presensi = array();
        foreach ($work as $k => $wk_tgl) {
            foreach ($data as $item) {
                if ($item->tanggal == $wk_tgl) {
                    if ($item->foto_masuk) {
                        $img_masuk = "/upload/presensi/" . $item->foto_masuk;
                    } else {
                        $img_masuk = "/themes/frontend/images/sma.png";
                    }
                    if ($item->foto_keluar) {
                        $img_keluar = "/upload/presensi/" . $item->foto_keluar;
                    } else {
                        $img_keluar = "/themes/frontend/images/sma.png";
                    }
                    if ($item->jam_masuk) {
                        $jammasuk = new \DateTime($item->jam_masuk);
                        $jam_masuk = $jammasuk->format('H:m:s');
                    } else {
                        $jam_masuk = "";
                    }
                    if ($item->jam_keluar) {
                        $jamkeluar = new \DateTime($item->jam_keluar);
                        $jam_keluar = $jamkeluar->format('H:m:s');
                    } else {
                        $jam_keluar = "";
                    }

                    $presensi[$wk_tgl] = [
                        'tanggal' => $wk_tgl,
                        'nama' => $history->nama,
                        'nisn' => $history->nisn,
                        'sex' => $history->sex,
                        'jam_masuk' => $jam_masuk,
                        'jam_keluar' => $jam_keluar,
                        'foto_masuk' => $img_masuk,
                        'foto_keluar' => $img_keluar,
                        'status' => $item->status
                    ];
                    break;
                } else {
                    $presensi[$wk_tgl] = [
                        'tanggal' => $wk_tgl,
                        'nama' => $history->nama,
                        'nisn' => $history->nisn,
                        'sex' => $history->sex,
                        'jam_masuk' => "",
                        'jam_keluar' => "",
                        'foto_masuk' => "/themes/frontend/images/sma.png",
                        'foto_keluar' => "/themes/frontend/images/sma.png",
                        'status' => ""
                    ];

                }
            }
        }
        return $presensi;
    }

    /**
     * @param array $work
     * @param $data
     * @param $history
     * @return array
     * @throws \Exception
     */
    public function presensiSesiResult(array $work, $data, $history)
    {
        $presensi = array();
        foreach ($data as $item){
            $jammasuk = new \DateTime($item->jam_masuk);
            $jam_masuk = $jammasuk->format('H:m:s');
            $presensi[] = [
                'tanggal' => $item->tanggal,
                'nama' => $history->nama,
                'nisn' => $history->nisn,
                'sex' => $history->sex,
                'sesi' => $item->sesi,
                'jam_masuk' => $jam_masuk,
                'status'    => $item->status,
            ];
        }
        $res = array();
        foreach($work as $v => $wk)
        {
            for($i=1;$i<=5;$i++)
            {
                foreach($presensi as $pres)
                {
                    if($pres['tanggal'] == $wk)
                    {
                        if($pres['sesi'] == $i)
                        {
                            $res[$wk]['tanggal'] = $wk;
                            $res[$wk]['nama'] = $history->nama;
                            $res[$wk]['nisn'] = $history->nisn;
                            $res[$wk]['sex'] = $history->sex;
                            $res[$wk]['sesi'][$i]= $pres['jam_masuk'];
                            $res[$wk]['status'] = $pres['status'];
                            break;
                        }else{
                            $res[$wk]['tanggal'] = $wk;
                            $res[$wk]['nama'] = $history->nama;
                            $res[$wk]['nisn'] = $history->nisn;
                            $res[$wk]['sex'] = $history->sex;
                            $res[$wk]['sesi'][$i]= "";
                        }
                    }else{
                        $res[$wk]['tanggal'] = $wk;
                        $res[$wk]['nama'] = $history->nama;
                        $res[$wk]['nisn'] = $history->nisn;
                        $res[$wk]['sex'] = $history->sex;
                        $res[$wk]['sesi'][$i]= "";
                    }
                }
            }
        }
        return $res;
    }
}