<?php

namespace SaeedVaziry\Monitoring\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResourceUsageMail extends Mailable
{
    use SerializesModels;

    /**
     * @var string
     */
    public $record;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $record)
    {
        $this->subject = $subject;
        $this->record = $record;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('monitoring::emails.resource-usage', [
            'subject' => $this->subject,
            'record' => $this->record
        ]);
    }
}
