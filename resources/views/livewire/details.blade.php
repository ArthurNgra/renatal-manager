<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex flex-row lg:flex-row lg:items-start">
            <!-- Image à gauche -->
            <div class="lg:w-1/3">
                <img src="{{ $url ?? 'https://via.placeholder.com/300' }}" alt="{{ $material->model }}" class="w-1/3 h-auto rounded-md">
            </div>
            <!-- Contenu à droite -->
            <div class="lg:w-2/3 lg:pl-8 mt-4 lg:mt-0">
                <h1 class="text-2xl font-bold text-gray-800">{{ $material->brand }} - {{ $material->model }}</h1>
                <p class="text-gray-600 mt-2">{{ $material->specs ?? 'Aucune spécification disponible.' }}</p>

                <div class="mt-4">
                    <span class="text-lg font-semibold text-gray-800">Série :</span>
                    <span class="text-gray-600">{{ $material->serial }}</span>
                </div>

                <div class="mt-4">
                    <span class="text-lg font-semibold text-gray-800">Prix :</span>
                    <span class="text-green-500">{{ $material->price ? number_format($material->price, 2) . ' €' : 'Non disponible' }}</span>
                </div>

                <div class="mt-4">
                    <span class="text-lg font-semibold text-gray-800">Problèmes :</span>
                    <span class="{{ $material->has_issue ? 'text-red-500' : 'text-green-500' }}">
                        {{ $material->has_issue ? 'Oui' : 'Non' }}
                    </span>
                </div>

                <div class="mt-6">
                    <a href="#" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
