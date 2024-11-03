<?php

namespace App\Mail;

use App\Models\ClientModel;
use App\Models\Company;
use App\Models\Devis;
use App\Models\MaterialModel;
use App\Models\RentalModel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use function config;

class DevisConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Devis $devis;
    protected ClientModel $client;
    /** @var array<MaterialModel> */
    protected array $materials;
    protected RentalModel $location;
    protected User $user;
    protected Company $company;
    protected string $url;
    protected string $token;
    protected string $filePath;

    public function __construct(Devis $devis, ClientModel $client, array $materials, RentalModel $location, User $user, Company $company, string $token, string $filePath)
    {
        $this->devis = $devis;
        $this->client = $client;
        $this->materials = $materials;
        $this->location = $location;
        $this->user = $user;
        $this->company = $company;
        $baseUrl = config('app.url');
        $this->url = $baseUrl . '/devis/' . $devis->id . '/acceptation';
        $this->token = $token;
        $this->filePath = $filePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Devis Confirmation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'devis.DevisConfirmation',
            with: [
                'devis' => $this->devis,
                'client' => $this->client,
                'materials' => $this->materials,
                'location' => $this->location,
                'user' => $this->user,
                'company' => $this->company,
                'url' => $this->url,
                'token' => $this->token,

            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            \Illuminate\Mail\Mailables\Attachment::fromPath($this->filePath)
                ->as('devis_attachment.pdf') // Change the name as needed
                 // Specify the MIME type
        ];
    }
}
