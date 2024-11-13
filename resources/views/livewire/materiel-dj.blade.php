<div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-4">
        @foreach($djs as $dj)
            <livewire:Components.card
                :material="$dj"
                :cat="$cat"
            />
        @endforeach
    </div>
</div>
