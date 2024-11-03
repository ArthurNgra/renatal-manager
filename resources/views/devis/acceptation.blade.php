<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le statut du devis</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-700">
<div class="container mx-auto mt-10 max-w-lg p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Changer le statut du devis</h1>

    <!-- Formulaire de changement de statut -->
    <form action="{{ route('transmettre.decision', [$devisId,$token]) }}" method="GET">
        <!-- Sélection du statut (valider ou refuser) -->
        <div class="mb-5">
            <input type="hidden" name="token" value="{{ $token }}">
            <label for="status" class="block text-gray-600 font-medium mb-2">Statut</label>
            <select name="status" id="status" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                <option value="valider">Valider</option>
                <option value="refuser">Refuser</option>
            </select>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">Confirmer votre choix</button>
    </form>
</div>
</body>
</html>
