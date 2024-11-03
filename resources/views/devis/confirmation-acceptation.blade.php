<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation du Statut du Devis</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-700">
<div class="container mx-auto mt-10 max-w-lg p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Confirmation du Statut du Devis</h1>

    <p class="text-lg mb-4">Merci pour votre retour concernant notre devis.</p>

    <p class="text-lg">Statut actuel du devis : <strong class="text-blue-600">{{$status}}</strong></p>

    <p class="text-gray-600 mt-6">Nous vous remercions de la confiance que vous nous accordez.</p>

    @if($status == 'refuser')
        <p class="text-gray-600 mt-4">
            N'hésitez pas à nous contacter afin que nous puissions affiner votre demande. Vous pouvez nous joindre à l'adresse suivante :
            <a href="mailto:votre.adresse@exemple.com" class="text-blue-500 underline">{{$company}}</a>.
        </p>
    @endif
</div>
</body>
</html>
