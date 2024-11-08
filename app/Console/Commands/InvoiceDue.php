<?php

namespace App\Console\Commands;

use App\Models\Facture;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InvoiceDue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:invoice-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        $delta = 0;
        Facture::all()->each(function ($facture) use ($today) {
            $delta = $today->diffInDays($facture->due_date);
            if ($delta < 0 && $delta > -15) {
                $facture->update(['status' => 'Retard']);
            }
            if ($delta<-15){
                $facture->update(['status' => 'Impayé']);
            }
            dd($delta);
        });
    }
}
