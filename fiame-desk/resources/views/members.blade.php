<x-guest-layout>
    <div class="relative rounded-xl overflow-auto p-8 h-screen">
        <div class="overflow-auto h-1/2 relative max-w-xl bg-white dark:bg-slate-800 dark:highlight-white/5 shadow-lg ring-1 ring-black/5 rounded-xl flex flex-col divide-y dark:divide-slate-200/5">
            <table class='table'>
                <tbody>
                    @foreach ($users as $user)
                    <tr class='divide-x-2'>
                        <td class="py-1 px-2 border-y ">{{ $user->firstname }}</td>
                        <td class="py-1 px-2 border-y ">{{ $user->lastname}}</td>
                        <td class="py-1 px-2 border-y ">{{ $user->phone }}</td>
                        <td class="py-1 px-2 border-y flex justify-center" x-data="{}">
                            <form method="POST" action="{{route('members') }}" x-ref="form">
                                <input name="admin" @click="$refs.form.submit()" type="checkbox" {{ $user->admin ? 'checked' : ''}} class="w-6 h-6 rounded-full" />
                                <input name="id" type="hidden" value="{{$user->id}}">
                                @csrf
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-guest-layout>