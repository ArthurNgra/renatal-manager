<div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-4">
        @foreach($decos as $deco)
            <livewire:Components.card

                :material="$deco"
                :cat="$cat"
            />
        @endforeach
    </div>
</div>
