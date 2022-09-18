<?php

namespace App\Mail;

use App\Models\NasdaqListedCompany;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockSearchRequested extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected NasdaqListedCompany $company;
    protected string $startDate;
    protected string $endDate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(NasdaqListedCompany $company, $startDate, $endDate) {
        $this->company = $company;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject($this->company->company_name)
            ->view('emails.stock_search.requested', [
                'startDate' => $this->startDate,
                'endDate' => $this->endDate
            ]);
    }
}
