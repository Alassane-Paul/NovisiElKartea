<?php

namespace App\Mail;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactSubmission $submission)
    {
        $this->submission = $submission;
        $this->locale('es');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $typeLabel = \App\Models\ContactSubmission::TYPES[$this->submission->type] ?? __('emails.form_type', [], 'es');
        $subjectText = $this->submission->subject ?? __('emails.no_subject', [], 'es');
        $fullSubject = __('emails.email_subject_prefix', [], 'es') . " ($typeLabel) : " . $subjectText;

        return $this->subject($fullSubject)
            ->view('emails.contact-form-premium');
    }
}
