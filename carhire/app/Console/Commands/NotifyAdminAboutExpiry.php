<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class NotifyAdminAboutExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify admin about documents nearing expiry';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $twoWeeksFromNow = Carbon::now()->addWeeks(2)->format('Y-m-d');

            $drivers = DB::table('driver')
                ->where('license_expiry_date', $twoWeeksFromNow)
                ->get();

            if ($drivers->count()) {
                foreach ($drivers as $driver) {
                    $driverLink = route('driver.show', ['id' => $driver->driver_id]);
                    $driver_id = 'D-' . str_pad($driver->driver_id, 5, '0', STR_PAD_LEFT);

                    $data = [
                        'html' => '<p>The following driver\'s license is about to expire: ' . $driver->first_name . ' ' . $driver->last_name . '(' . $driver_id . ')' . '</p>' .
                            '<p>View Driver: <a href="' . $driverLink . '">Driver Link</a></p>',
                        'subject' => 'License Expiry Notification',
                    ];

                    email($data);
                }
            }

            $bookings = DB::table('booking')
                ->where('end_date', $twoWeeksFromNow)
                ->get();

            if ($bookings->count()) {
                foreach ($bookings as $booking) {
                    $bookingLink = route('booking.show', ['id' => $booking->booking_id]);
                    $booking_id = 'B-' . str_pad($booking->booking_id, 5, '0', STR_PAD_LEFT);

                    $data = [
                        'html' => '<p>The following booking contract is about to end: ' . $booking_id . '</p>' .
                            '<p>View Booking: <a href="' . $bookingLink . '">Booking Link</a></p>',
                        'subject' => 'Booking Contract Expiry Notification',
                    ];

                    email($data);
                }
            }
            $this->info('Admin notified about expiring documents and bookings.');
        } catch (\Throwable $th) {
            $this->error('An error occurred while notifying admin about expiring documents and bookings.');
        }
    }
}
