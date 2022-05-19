<x-app-layout>
    <div class="relative">
        <button class="absolute right-0 top-0 h-16 w-16 m-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-13 w-13" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
    <div class="absolute grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2">
        @foreach ($gatherings as $gathering)
        <div class="max-w-md py-5 px-5 bg-white shadow-lg rounded-lg mx-10 my-10">
            <span>{{ date('d F Y', strtotime($gathering->date)); }}</span><br>
            <div class="my-4">{{ $gathering->description }}</div>
            @if(Auth::user()->id == 1)
            <form method="POST" action="{{route('events.delete',$gathering->id) }}">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                    </svg>
                </button>
                @csrf
            </form>
            @endif
        </div>
        @endforeach
    </div>
</x-app-layout>