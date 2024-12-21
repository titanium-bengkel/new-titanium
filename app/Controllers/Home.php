<?

namespace App\Controllers;

use App\Models\M_Po;
use App\Models\M_RepairOrder;
use App\Models\M_ReportJurnal;

class Home extends BaseController
{
    public function index()
    {


        // Instansiasi model
        $poModel = new M_Po();
        $repairModel = new M_RepairOrder();
        $jurnalModel = new M_ReportJurnal();

        // Mengambil bulan dan tahun saat ini
        $bulanIni = date('m');
        $tahunIni = date('Y');

        // Menghitung jumlah hari dalam bulan ini menggunakan DateTime
        $jumlahHari = (new \DateTime("$tahunIni-$bulanIni-01"))->format('t');

        // Menyusun laporan pendapatan berdasarkan tanggal
        $reportPendapatan = [];
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $tanggal = sprintf('%04d-%02d-%02d', $tahunIni, $bulanIni, $i);

            // Mengambil total kredit berdasarkan kode COA dan tanggal
            $totalJasa = $jurnalModel->where('account', '41110')->where('date', $tanggal)->selectSum('kredit')->get()->getRow()->kredit ?? 0;
            $totalCat = $jurnalModel->where('account', '41140')->where('date', $tanggal)->selectSum('kredit')->get()->getRow()->kredit ?? 0;
            $totalNonCat = $jurnalModel->where('account', '41130')->where('date', $tanggal)->selectSum('kredit')->get()->getRow()->kredit ?? 0;
            $totalSparepart = $jurnalModel->where('account', '41120')->where('date', $tanggal)->selectSum('kredit')->get()->getRow()->kredit ?? 0;

            $reportPendapatan[] = [
                'tanggal' => $tanggal,
                'jasa' => $totalJasa,
                'cat' => $totalCat,
                'non_cat' => $totalNonCat,
                'sparepart' => $totalSparepart,
                'total' => $totalJasa + $totalCat + $totalNonCat + $totalSparepart
            ];
        }

        // Data lain untuk dashboard
        $prosesKlaimCount = $poModel->where('progres', 'Proses Klaim')->countAllResults();
        $accAsuransiCount = $poModel->where('status', 'Acc Asuransi')->countAllResults();
        $menungguSparepartCount = $poModel->where('progres', 'Menunggu Sparepart')->countAllResults();
        $menungguSupplyCount = $poModel->where('progres', 'Menunggu Supply')->countAllResults();
        $siapMasukCount = $poModel->where('progres', 'Siap Masuk')->countAllResults();
        $bengkelTitaniumCount = $poModel->countBengkelTitanium();
        $bengkelTandameCount = $poModel->where('bengkel', 'TANDEM')->countAllResults();
        $repairOrderCount = $repairModel->countAllResults();
        $mobilMasuk = $repairModel->getDailyReport();

        // Menyusun data untuk dikirim ke view
        $data = [
            'title' => 'Home',
            'poData' => $poModel->findAll(),
            'preOrderCount' => $poModel->where('status', 'Pre-order')->countAllResults(),
            'prosesKlaimCount' => $prosesKlaimCount,
            'menungguSparepartCount' => $menungguSparepartCount,
            'menungguSupplyCount' => $menungguSupplyCount,
            'siapMasukCount' => $siapMasukCount,
            'accAsuransiCount' => $accAsuransiCount,
            'bengkelTitaniumCount' => $bengkelTitaniumCount,
            'bengkelTandameCount' => $bengkelTandameCount,
            'repairOrder' => $repairOrderCount,
            'mobilMasuk' => $mobilMasuk,
            'reportPendapatan' => $reportPendapatan, // Laporan pendapatan harian
        ];

        return view('/index', $data);
    }

    public function dsb_keuangan()
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('dashboard/dashboard_keuangan', $data);
    }
}
