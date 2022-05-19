<x-app-layout>
    <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2">
        @foreach ($gatherings as $gathering)
        <div class="max-w-md py-5 px-5 bg-white shadow-lg rounded-lg mx-10 my-10">
            <span>{{ date('d F Y', strtotime($gathering->date)); }}</span><br>
            <div class="my-4">{{ $gathering->description }}</div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
            </svg>
        </div>
        @endforeach
    </div>
</x-app-layout>