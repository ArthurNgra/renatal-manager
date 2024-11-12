<div class="bg-gray-800 text-white py-10 px-3">
    <div class="container mx-auto grid grid-cols-1 gap-8 md:grid-cols-3 md:gap-8 space-y-8 md:space-y-0">

        <!-- Section: Plan du site -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Plan du site</h3>
            <ul class="space-y-2">
                <li><a href="/home" class="hover:underline">Accueil</a></li>
                <li><a href="/about" class="hover:underline">À propos</a></li>
                <li><a href="/services" class="hover:underline">Services</a></li>
                <li><a href="/contact" class="hover:underline">Contact</a></li>
            </ul>
        </div>

        <!-- Section: Réseaux sociaux -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Suivez-nous</h3>
            <ul class="flex flex-col items-start space-y-2 md:space-y-0 md:flex-row md:space-x-4">
                <li>
                    <a href="https://facebook.com" target="_blank" class="hover:text-gray-400">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com" target="_blank" class="hover:text-gray-400">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    </a>
                </li>
                <li>
                    <a href="https://instagram.com" target="_blank" class="hover:text-gray-400">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Section: Newsletter -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
            <form wire:submit.prevent="subscribe">
                <div class="flex flex-col space-y-2">
                    <input type="email" wire:model="email" class="p-2 bg-gray-700 text-white rounded" placeholder="Votre email">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 rounded">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-8 text-center text-gray-400">
        &copy; 2024 One Big Cartel. Tous droits réservés.
    </div>
</div>
