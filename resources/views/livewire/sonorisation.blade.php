<div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-4">
        @foreach($sonos as $sono)
            <livewire:Components.card
                :material="$sono"
                :cat="$cat"
            />
        @endforeach
    </div>
</div>
