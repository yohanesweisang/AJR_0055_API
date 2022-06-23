<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function pdfPenyewaan($month, $year){
        $laporan = DB::select("SELECT m.tipe_mobil, m.nama_mobil, COUNT(t.id_transaksi) AS jumlah_peminjaman, 
        SUM(t.subtotal_transaksi+t.biaya_ekstensi_pembayaran-t.diskon_pembayaran) AS pendapatan FROM transaksi t 
        JOIN mobil m ON(t.id_mobil=m.id_mobil) WHERE t.status_transaksi='Selesai' AND $month=(SELECT MONTH(t.TGL_TRANSAKSI)) AND $year=(SELECT YEAR(t.TGL_TRANSAKSI)) 
        GROUP BY m.tipe_mobil, m.nama_mobil ORDER BY COUNT(t.id_transaksi) DESC");

        if(count($laporan) > 0){
            return response([
                'message' => 'Berhasil dicetak!',
                'laporan' => $laporan
            ], 200);
        }

        return response([
            'message' => 'Tidak berhasil dicetak!',
            'laporan' => $laporan
        ], 400);
    }

    public function pdfDetailPendapatan($month, $year){
        $laporan = DB::select("SELECT c.nama, m.nama_mobil, if(t.format_transaksi LIKE '%01-', 'Peminjaman Mobil + Driver', 'Peminjaman Mobil') AS jenis_transaksi, 
        COUNT(t.id_transaksi) AS jumlah_transaksi, SUM(t.subtotal_transaksi+t.biaya_ekstensi_pembayaran-t.diskon_pembayaran) AS pendapatan FROM transaksi t 
        JOIN customer c ON(t.id_customer=c.id_customer) JOIN mobil m ON(t.id_mobil=m.id_mobil) WHERE t.status_transaksi='Selesai' AND $month=(SELECT MONTH(t.tgl_transaksi)) AND $year=(SELECT YEAR(t.tgl_transaksi)) 
        GROUP BY c.nama, m.nama_mobil, t.format_transaksi");

        if(count($laporan) > 0){
            return response([
                'message' => 'Berhasil dicetak!',
                'laporan' => $laporan
            ], 200);
        }

        return response([
            'message' => 'Tidak berhasil dicetak!',
            'laporan' => $laporan
        ], 400);
    }

    public function pdfDriverPerbulan($month, $year){
        $laporan = DB::select("SELECT CONCAT(d.format_driver, d.id_driver) AS id_driver, d.nama_driver, COUNT(t.id_transaksi) AS jumlah_transaksi 
        FROM driver d JOIN transaksi t ON(d.id_driver=t.id_driver) WHERE t.status_transaksi='Selesai' AND $month=(SELECT MONTH(t.tgl_transaksi)) AND $year=(SELECT YEAR(t.tgl_transaksi)) 
        GROUP BY d.id_driver, d.format_driver, d.nama_driver ORDER BY COUNT(t.id_transaksi) DESC LIMIT 5");

        if(count($laporan) > 0){
            return response([
                'message' => 'Berhasil dicetak!',
                'laporan' => $laporan
            ], 200);

        }

        return response([
            'message' => 'Tidak berhasil dicetak!',
            'laporan' => $laporan
        ], 400);
    }

    public function pdfPerformaDriver($month, $year){
        $laporan = DB::select("SELECT CONCAT(d.format_driver,d.id_driver) AS id_driver, d.nama_driver, COUNT(t.id_transaksi) AS jumlah_transaksi,
        d.rerata_rating_driver FROM driver d JOIN transaksi t ON(d.id_driver=t.id_driver) WHERE t.status_transaksi='Selesai' AND $month=(SELECT MONTH(t.tgl_transaksi)) AND $year=(SELECT YEAR(t.tgl_transaksi)) 
        GROUP BY d.id_driver, d.format_driver, d.nama_driver, d.rerata_rating_driver  ORDER BY COUNT(t.id_transaksi) DESC");

        if(count($laporan) > 0){
            return response([
                'message' => 'Berhasil dicetak!',
                'laporan'    => $laporan
            ], 200);
        }

        return response([
            'message' => 'Tidak berhasil dicetak!',
            'laporan' => $laporan
        ], 400);
    }

    public function pdfCustomer($month, $year){
        $laporan = DB::select("SELECT c.nama, COUNT(t.id_transaksi) AS jumlah_transaksi FROM customer c 
        JOIN transaksi t ON(c.id_customer=t.id_customer) WHERE t.status_transaksi='Selesai' AND $month=(SELECT MONTH(t.tgl_transaksi)) AND $year=(SELECT YEAR(t.tgl_transaksi)) 
        GROUP BY c.id_customer, c.nama ORDER BY COUNT(t.id_transaksi) DESC LIMIT 5");

        if(count($laporan) > 0){
            return response([
                'message' => 'Berhasil dicetak!',
                'laporan' => $laporan
            ], 200);

        }

        return response([
            'message' => 'Tidak berhasil dicetak!',
            'laporan' => $laporan
        ], 400);
    }
}
