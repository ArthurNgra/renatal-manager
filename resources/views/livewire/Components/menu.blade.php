<div class="bg-white border-2">
    <div class="mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="#" class="text-3xl font-omnesBold">One Big Cartel</a>
            </div>

            <!-- Menu items (Desktop) -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="/" wire:navigate class="px-3 py-2 rounded-md text-sm font-medium font-omnesBold {{ $activeMenu === '/' ? 'border-grey-900 border-b-2' : '' }}" wire:click.prevent="setActiveMenu('/')">
                        Home
                    </a>
                    <a href="/dj" wire:navigate class="px-3 py-2 rounded-md text-sm font-medium font-omnesBold {{ $activeMenu === 'dj' ? 'border-grey-900 border-b-2' : '' }}" wire:click.prevent="setActiveMenu('dj')">
                        DJ
                    </a>
                    <a href="/sono" wire:navigate class="px-3 py-2 rounded-md text-sm font-medium font-omnesBold {{ $activeMenu === 'sono' ? 'border-grey-900 border-b-2' : '' }}" wire:click.prevent="setActiveMenu('sono')">
                        Sonorisation
                    </a>
                    <a href="/lights" wire:navigate class="px-3 py-2 rounded-md text-sm font-medium font-omnesBold {{ $activeMenu === 'lights' ? 'border-grey-900 border-b-2' : '' }}" wire:click.prevent="setActiveMenu('lights')">
                        Light
                    </a>
                    <a href="/deco" wire:navigate class="px-3 py-2 rounded-md text-sm font-medium font-omnesBold {{ $activeMenu === 'deco' ? 'border-grey-900 border-b-2' : '' }}" wire:click.prevent="setActiveMenu('deco')">
                        Décoration
                    </a>
                    <a href="/technique" wire:navigate class="px-3 py-2 rounded-md text-sm font-medium font-omnesBold {{ $activeMenu === 'technique' ? 'border-grey-900 border-b-2' : '' }}" wire:click.prevent="setActiveMenu('technique')">
                        Technique
                    </a>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button type="button"
                        class="bg-white-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                        onclick="toggleMobileMenu()">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden border-l-2 border-gray-300 fixed left-0 top-0 h-full w-2/4 bg-white">
            <div class="mt-5 px-6">
                <a href="/" wire:navigate.prefetch class="block mb-4 text-sm font-omnes text-gray-700 hover:bg-gray-100 {{ $activeMenu === '/' ? 'border-l-4 border-gray-800 pl-2' : '' }}" wire:click.prevent="setActiveMenu('/')">
                    Home
                </a>
                <a href="/dj" wire:navigate.prefetch class="block mb-4 text-sm font-omnes text-gray-700 hover:bg-gray-100 {{ $activeMenu === 'dj' ? 'border-l-4 border-gray-800 pl-2' : '' }}" wire:click.prevent="setActiveMenu('dj')">
                    DJ
                </a>
                <a href="/sono" wire:navigate.prefetch class="block mb-4 text-sm font-omnes text-gray-700 hover:bg-gray-100 {{ $activeMenu === 'sono' ? 'border-l-4 border-gray-800 pl-2' : '' }}" wire:click.prevent="setActiveMenu('sono')">
                    Sonorisation
                </a>
                <a href="/lights" wire:navigate.prefetch class="block mb-4 text-sm font-omnes text-gray-700 hover:bg-gray-100 {{ $activeMenu === 'lights' ? 'border-l-4 border-gray-800 pl-2' : '' }}" wire:click.prevent="setActiveMenu('lights')">
                    Light
                </a>
                <a href="/deco" wire:navigate.prefetch class="block mb-4 text-sm font-omnes text-gray-700 hover:bg-gray-100 {{ $activeMenu === 'deco' ? 'border-l-4 border-gray-800 pl-2' : '' }}" wire:click.prevent="setActiveMenu('deco')">
                    Décoration
                </a>
                <a href="/technique" wire:navigat.prefetche class="block mb-4 text-sm font-omnes text-gray-700 hover:bg-gray-100 {{ $activeMenu === 'technique' ? 'border-l-4 border-gray-800 pl-2' : '' }}" wire:click.prevent="setActiveMenu('technique')">
                    Technique
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }
</script>
