<x-app-layout>
    <div class="relative rounded-xl overflow-auto p-8 h-screen grid grid-cols-2">
        <div class="overflow-auto h-1/2 relative max-w-xl bg-white dark:bg-slate-800 dark:highlight-white/5 shadow-lg ring-1 ring-black/5 rounded-xl flex flex-col divide-y dark:divide-slate-200/5">
            <table class='table'>
                <tbody>
                    @foreach ($users as $user)
                    <tr class='divide-x-2'>
                        <td class="py-1 px-2 border-y ">{{ $user->firstname }}</td>
                        <td class="py-1 px-2 border-y ">{{ $user->lastname}}</td>
                        <td class="py-1 px-2 border-y ">{{ $user->phone }}</td>
                        <td class="py-1 px-2 border-y flex justify-center" x-data="{}">
                            <form method="POST" action="{{route('members.update',$user->id) }}" x-ref="form">
                                @if ($user->id == auth()->user()->id)
                                <input name="admin" disabled type="checkbox" checked class="w-6 h-6 rounded-full" />
                                @else
                                <input name="admin" @click="$refs.form.submit()" type="checkbox" {{ $user->admin ? 'checked' : ''}} class="w-6 h-6 rounded-full" />
                                @endif
                                <input name="id" type="hidden" value="{{$user->id}}">
                                @csrf
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="overflow-auto h-4/6 relative max-w-xl bg-white dark:bg-slate-800 dark:highlight-white/5 shadow-lg ring-1 ring-black/5 rounded-xl flex flex-col divide-y dark:divide-slate-200/5">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('users.store') }}">
                <h2 class="text-center py-5 font-bold">Ajouter un membre</h2>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                        Prénom
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstname" name="firstname" type="text">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                        Nom
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" name="lastname" type="text">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Numéro de téléphone
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" type="text">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Mot de passe
                    </label>
                    <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password">
                    <p class="text-red-500 text-xs italic">Entrez un mot de passe</p>
                </div>
                <div class="md:flex md:items-left mb-6" for='formAdmin'>
                    <label class="md:w-2/3 block text-gray-500 font-bold">
                        <input class="mr-2 leading-tight" id="formAdmin" name="formAdmin" type="checkbox">
                        <span class="text-sm">
                            Nommer administrateur
                        </span>
                    </label>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Ajouter
                    </button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</x-guest-layout>