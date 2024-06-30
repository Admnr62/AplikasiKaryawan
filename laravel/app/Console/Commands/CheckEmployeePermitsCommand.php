<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Manpower;
use Carbon\Carbon;
use Mail;

class CheckEmployeePermitsCommand extends Command
{
    protected $signature = 'check:employee_permits';

    protected $description = 'Check employee permits and send email if expiring within 2 months.';

    public function handle()
    {
        // Mengambil semua data karyawan
        $employees = Manpower::all();

        foreach ($employees as $employee) {
            $expiryDate = Carbon::parse($employee->masa_berlaku_permit);
            $twoMonthsFromNow = Carbon::now()->addMonths(2);

            // Memeriksa apakah masa berlaku akan kedaluwarsa dalam 2 bulan
            if ($expiryDate <= $twoMonthsFromNow) {
                // Kirim email notifikasi
                $this->sendNotificationEmail($employee);
            }
        }
    }

    private function sendNotificationEmail($employee)
    {
        // Kirim email notifikasi
        Mail::raw('Masa berlaku ID karyawan akan kedaluwarsa dalam 2 bulan.', function ($message) use ($employee) {
            $message->to($employee->email)->subject('Notifikasi Masa Berlaku ID Karyawan');
        });
    }
}
