<?php

namespace App\Services;

use App\Http\Requests\ContactRequest;
use App\Models\Company;
use App\Models\Contact as ContactModel;
use Illuminate\Support\Carbon;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\URL;

class ContactService
{


    public static function create(array $data)
    {
        $contact=ContactModel::create($data);
        $users = Company::find(1)->users;
        $company = Company::find(1)->mail;


        foreach ($users as $user) {
            $user->notify(
                NovaNotification::make()
                    ->message('Demande de contact' . ' ' . $contact->nom . ' ' )
                    ->action('Voir', URL::remote('/admin/resources/contacts/' . $contact->id))

            );
        }
    }
}
