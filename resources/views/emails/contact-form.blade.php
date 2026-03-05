<x-mail::message>
    # Nouvelle soumission de formulaire

    Un nouveau formulaire a été soumis sur le site **Novisi El Kartea**.

    **Type :** {{ \App\Models\ContactSubmission::TYPES[$submission->type] ?? $submission->type }}
    **Nom :** {{ $submission->name }}
    **Email :** {{ $submission->email }}
    **Téléphone :** {{ $submission->phone ?? 'N/A' }}
    **Sujet :** {{ $submission->subject ?? 'N/A' }}

    **Message :**
    {{ $submission->message }}

    <x-mail::button :url="config('app.url') . '/cpanel'">
        Accéder au tableau de bord
    </x-mail::button>

    Merci,<br>
    L'équipe {{ config('app.name') }}
</x-mail::message>