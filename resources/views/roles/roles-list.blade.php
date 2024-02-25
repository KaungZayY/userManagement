<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Roles List') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <!-- table start -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                <thead>
                    <tr class="text-left text-gray-500 text-xs">
                        <th class="py-2 w-1/2">Role</th>
                        <th class="py-2 w-1/2">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                @if ($roles->count())
                    @foreach ($roles as $role)
                    <tr class="">
                        <td class="py-2">{{$role->name}}</td>
                        @if ($role->id==1)
                            <td class="py-2 text-sm">Default Role</td>
                        @else
                        <td class="py-2 text-sm">
                            @if (viewContent('Roles','Update'))
                                <div class="inline-block mr-1">
                                    <form action="{{route('role.edit',$role)}}" method="GET">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                                                <path fill="#22C55E" d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                            @if (viewContent('Roles','Delete'))
                                <div class="inline-block ml-1">
                                    <form action="{{route('role.delete',$role)}}" method="POST" onsubmit="return confirm('Remove this role?');">
                                        @csrf
                                        @method('DELETE')
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                                                <path fill="#EF4444" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="py-2 px-4 text-center" colspan="2">No Data found</td>
                    </tr>
                @endif
                </tbody>
                </table>
            </div>
    </div>
</x-app-layout>
