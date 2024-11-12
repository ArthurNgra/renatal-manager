<div class="bg-gray-800 text-white py-10 px-3">
    <div class="container mx-auto grid grid-cols-1 gap-8 md:grid-cols-3 md:gap-8">

        <!-- Section: Plan du site -->
        <div class="text-left">
            <h3 class="text-lg font-omnesBold mb-4">Plan du site</h3>
            <ul class="space-y-2 font-omnes">
                <li><a href="/" class="hover:underline">Home</a></li>
                <li><a href="/dj" class="hover:underline">DJ</a></li>
                <li><a href="/sono" class="hover:underline">Sonorisation</a></li>
                <li><a href="/lights" class="hover:underline">Light</a></li>
                <li><a href="/deco" class="hover:underline">Décoration</a></li>
                <li><a href="/technique" class="hover:underline">Technique</a></li>
            </ul>
        </div>

        <!-- Section: Réseaux sociaux -->
        <div>
            <h3 class="text-lg font-omnesBold mb-4">Suivez-nous</h3>
            <ul class="flex flex-col items-start space-y-2 md:space-y-0 md:flex-row md:space-x-4 font-omnes">
                <li>
                    <a href="https://www.soscartelradio.com/" target="_blank" class="hover:text-gray-400">
                        <img class="w-6 h-6" src="{{ asset('img/son-donde.svg') }}" alt="Site Web">
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/cartelonebig_/" target="_blank" class="hover:text-gray-400">
                        <img class="w-6 h-6" src="{{ asset('img/instagram.svg') }}" alt="Instagram">
                    </a>
                </li>
            </ul>
        </div>

        <!-- Section: Newsletter -->
        <div>
            <h3 class="text-lg font-omnesBold mb-4">Newsletter</h3>
            <form wire:submit.prevent="subscribe">
                <div class="flex flex-col space-y-2 font-omnes">
                    <input type="email" wire:model="email" class="p-2 bg-gray-700 text-white rounded" placeholder="Votre email">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 rounded">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-8 text-center text-gray-400 font-omnes">
        &copy; 2024 One Big Cartel. Tous droits réservés.
    </div>
</div>
