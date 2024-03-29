<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    @if (viewContent('Users','View'))
        <x-sidebar.dropdown
            title="Users"
            :active="Str::startsWith(request()->route()->uri(), 'users')"
        >
            <x-slot name="icon">
                <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>

            <x-sidebar.sublink
                title="Users List"
                href="{{ route('users.list') }}"
                :active="request()->routeIs('users.list')"
            />
            @if (viewContent('Users','Create'))
                <x-sidebar.sublink
                    title="Create User"
                    href="{{ route('users.create') }}"
                    :active="request()->routeIs('users.create')"
                />
            @endif
            {{-- <x-sidebar.sublink
                title="Import User"
                
            /> --}}
        </x-sidebar.dropdown>
    @endif

    @if (viewContent('Roles','View'))
    <x-sidebar.dropdown
        title="Roles"
        :active="Str::startsWith(request()->route()->uri(), 'roles')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Roles List"
            href="{{ route('roles.list') }}"
            :active="request()->routeIs('roles.list')"
        />
        @if (viewContent('Roles','Create'))
            <x-sidebar.sublink
                title="Create Role"
                href="{{ route('roles.create') }}"
                :active="request()->routeIs('roles.create')"
            />
        @endif
    </x-sidebar.dropdown>
    @endif

    {{-- <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
        Dummy Links
    </div>

    @php
        $links = array_fill(0, 20, '');
    @endphp

    @foreach ($links as $index => $link)
        <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />
    @endforeach --}}

</x-perfect-scrollbar>
