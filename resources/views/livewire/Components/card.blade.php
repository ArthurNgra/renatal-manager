<div>
    <a href="{{ url(strtolower($cat->name).'/' . $material->id. '/details/') }}" wire:navigate.prefetch>
        <div class="bg-white border rounded-lg shadow-md overflow-hidden">
            <img src="{{ $photo }}" alt="{{ $brand }} {{ $model }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-bold text-gray-900">{{ $brand }}</h3>
                <p class="text-gray-700">{{ $model }}</p>
                <p class="text-gray-500 font-semibold mt-2">{{ number_format($price, 2) }} €</p>
            </div>
        </div>
    </a>
</div>
