<x-app-layout>
    @if(Auth::user()->id == 1)
    <div x-data="{open : false, confirmed : false, showConfirmation : false,  gatherings : @js($gatherings->pluck('date'))}">
        <div class="relative">
            <button class="absolute z-10 right-0 top-0 h-16 w-16 m-5" x-on:click="open = ! open">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-13 w-13" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div class="w-full max-w-xs m-5" x-show="open">
            <form method="POST" action="{{ route('events.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" x-ref="form">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name='description' id="description" type="text" value="{{old('description')}}" placeholder="Description">
                    @error('description')
                    <span x-show="open = true" class=" text-red-500 text-sm"> {{$message}}</span>
                    @enderror
                </div>
                <div class="flex items-center justify-center">
                    <div class="datepicker relative form-floating mb-3 xl:w-96" data-mdb-toggle-button="false">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                            Date
                        </label>
                        <input name="date" type="date" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" value="{{old('date')}}" x-ref="date" placeholder="20/11/2019" />
                        <div x-show="showConfirmation"><span class="text-blue-500 text-sm">Il y à déjà un événement à cette date. Voulez-vous l'écraser ?</span><br>
                            <button class="rounded bg-blue-500" @click="confirmed = true">Confirmer</button>
                        </div>
                        @error('date')
                        <span x-show="open = true" class=" text-red-500 text-sm"> {{$message}}</span>
                        @enderror
                        <button class="datepicker-toggle-button" data-mdb-toggle="datepicker">
                            <i class="fas fa-calendar datepicker-toggle-icon"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" @click.prevent="gatherings.includes($refs.date.value) && confirmed == false ? showConfirmation = true : $refs.form.submit()">
                            Sauvegarder
                        </button>
                    </div>
                </div>
                @csrf
            </form>
        </div>
        @endif
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
    </div>
</x-app-layout>