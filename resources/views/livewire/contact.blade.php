
    <div class="rounded-lg shadow-lg px-20  py-20 flex justify-center w-3/4 bg-white">


        <form wire:submit.prevent="submit" class="w-full p-4">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" id="name" wire:model="name"
                       class="mt-1 block w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" wire:model="email"
                       class="mt-1 block w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Tel</label>
                <input type="tel" id="phone" wire:model="phone"
                       class="mt-1 block w-full px-4 py-2 border @error('phone') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea id="message" wire:model="message" rows="4"
                          class="mt-1 block w-full px-4 py-2 border @error('message') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            @if (session()->has('success'))
                <div class="mb-4 p-4 text-green-700 bg-green-100 font-omnes rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="text-red-500 text-sm">
                    {{ session('error') }}
                </div>
            @endif
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 font-omnesBold rounded-lg w-full">
                Envoyer
            </button>
        </form>
    </div>


