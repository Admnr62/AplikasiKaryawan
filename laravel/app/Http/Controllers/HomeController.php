<?php

namespace App\Http\Controllers;
use App\Models\Manpower; 
use Carbon\Carbon;


use Illuminate\Http\Request;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
 public function index()
    {
        // Mengambil semua data Manpower dari database
        $manpower = Manpower::all();

        // Menghitung total Manpower
        $totalManpower = $manpower->count();

        // Menghitung jumlah Manpower berdasarkan Customer
        $manpowerByCustomer = $manpower->groupBy('customer')
            ->map(function ($group) {
                return $group->count();
            });

        // Menghitung jumlah Manpower berdasarkan Jabatan di setiap Customer
        $manpowerByJobTitle = $manpower->groupBy(['customer', 'jabatan'])
            ->map(function ($group) {
                return $group->count();
            });

        // Menghitung jumlah Manpower berdasarkan jenis kelamin
        $manpowerByGender = $manpower->groupBy('gender')
            ->map(function ($group) {
                return $group->count();
            });

            // Mengambil jumlah manpower tahun ini
        $manpowerThisYear = Manpower::whereYear('created_at', date('Y'))->count();

        // Mengambil jumlah manpower tahun lalu
        $manpowerLastYear = Manpower::whereYear('created_at', date('Y') - 1)->count();

        // Menghitung kenaikan persentase
        if ($manpowerLastYear > 0) {
            $percentageIncrease = ($manpowerThisYear - $manpowerLastYear) / $manpowerLastYear * 100;
        } else {
            $percentageIncrease = 0; // Jika tidak ada data tahun sebelumnya
        }
        // Mengambil trend Manpower dari bulan Januari hingga Desember
        $trendManpower = Manpower::whereYear('created_at', '=', date('Y'))
            ->orderBy('created_at')
            ->get();

        // Mengambil data Manpower yang masa berlaku ID-nya akan expired dalam 2 bulan ke depan
        $expiringSoon = $manpower->filter(function ($employee) {
            $expiryDate = Carbon::parse($employee->masa_berlaku_permit);
            return $expiryDate->isBetween(now(), now()->addMonths(2));
        });

        // Mengirimkan data ke view 'dashboard'
        return view('pages.dashboard', compact('totalManpower','manpower', 'manpowerByCustomer', 'manpowerByJobTitle', 'manpowerByGender', 'trendManpower', 'expiringSoon','manpowerThisYear','percentageIncrease'));
    }


}
