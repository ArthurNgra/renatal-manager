<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="m-4 p-4 justify-center lg:justify-start">
            <a href="{{ url('/' . strtolower($material->category->name)) }}" class="bg-gray-800  font-omnesBold  py-2 px-4 text-center text-white rounded">
                Retour
            </a>
        </div>

        <div class="flex sm:flex-col  lg:flex-row lg:items-start lg:justify-start">
            <!-- Image à gauche (ou en haut sur mobile) -->
            <div class="lg:w-1/3 flex lg:justify-start mb-4 lg:mb-0">
                <img src="{{ $url }}" alt="{{ $material->model }}" class="w-2/3 sm:w-1/2 lg:w-full h-auto rounded-md">
            </div>
            <!-- Contenu à droite (ou en bas sur mobile) -->
            <div class="lg:w-2/3 lg:pl-8 p-4  lg:text-left">
                <h1 class="text-xl lg:text-2xl font-omnesBold text-gray-800">{{ $material->brand }} - {{ $material->model }}</h1>
                <p class="text-gray-600 mt-2">{{ $material->specs ?? 'Aucune spécification disponible.' }}</p>

                <div class="mt-4">
                    <span class="text-lg font-omnes text-gray-800">Location :</span>
                    <span class="text-green-500">{{ $material->price ? number_format($material->price, 2) . ' € HT' : 'Non disponible' }}</span>
                </div>
            </div>
        </div>

    </div>
</div>
