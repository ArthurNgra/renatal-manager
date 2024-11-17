<?php

namespace App\Livewire\Pages;

use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter as RateLimiterFacade;
use Livewire\Component;
use function config;

class Contact extends Component
{
    protected $rules = [
        'name' => 'required|string|min:3',
        'email' => 'required|email',
        'message' => 'required|string|min:10',
        'phone' => 'required|string|min:10',
    ];
    public $name;
    public $email;
    public $message;
    public $phone;


    public function submit()
    {
        $key = 'contact-form:' . request()->ip();

        if (RateLimiterFacade::tooManyAttempts($key, 3)) {
            session()->flash('error', 'Trop de tentatives dans les dernières minutes. Veuillez réessayer plus tard.');
            return;
        }

        RateLimiterFacade::hit($key, 120); // 60 secondes (1 minute)

        $validated = $this->validate();

        try {
            // Logique d'envoi de mail
            Mail::send('emails.contact', [
                'name' => $this->name,
                'email' => $this->email,
                'messageContent' => $this->message,
            ], function ($mail) {
                $mail->to($this->email)
                    ->subject('Demande de contact')
                    ->from(config('mail.mailers.smtp.username'), config('mail.from.name'));

            });

            (new ContactService())->create($validated);
            session()->flash('success', 'Votre message a bien été transmis');
            $this->reset();
        } catch (\Symfony\Component\Mailer\Exception\TransportExceptionInterface $e) {
            if (str_contains($e->getMessage(), '554')) {
                session()->flash('error', 'Impossible d\'envoyer le message. Veuillez vérifier votre adresse email ou réessayer plus tard.');
            } else {
                session()->flash('error', 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer plus tard.');
            }
        } catch (\Throwable $e) {
            session()->flash('error', 'Une erreur inattendue est survenue. Veuillez réessayer plus tard.');
        }
    }


    public function render()
    {
        return view('livewire.contact');
    }
}
