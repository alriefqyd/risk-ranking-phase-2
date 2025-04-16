<?php

namespace App\Mail;

use App\Models\RevisionLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubmissionNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $subject = 'New Business Case Submitted: "' . $this->data->project_name . '" – Review Required';
        if($this->data->version > 1){
            $subject = 'Updated Business Case: "' . $this->data->project_name . '" – Review Required';
        }
        return new Envelope(
            subject: $subject
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $latestLog = RevisionLog::where('project_id', $this->data->id)
            ->orderByDesc('revision') // or 'created_at' if available
            ->first(); // Get only the newest log

        return new Content(
            view: 'mail.submission_notification',
            with: [
                'data' => $this->data,
                'log' => $latestLog, // pass single log, not list
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
