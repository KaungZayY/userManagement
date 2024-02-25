<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create new Role') }}
            </h2>
        </div>
    </x-slot>

    <form action="{{route('role.update',$role)}}" method="POST">
        @csrf
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="flex flex-col">
                <!-- Role Name -->
                <div class="mt-4 flex flex-col items-start">
                    <x-form.label
                        for="name"
                        :value="__('Role Name : ')"
                        class="text-left mb-2"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-shield-check aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="name"
                            class="block w-full"
                            type="text"
                            name="name"
                            required
                            autofocus
                            placeholder="{{ __('Name') }}"
                            value="{{$role->name}}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>
                @include('components.form.error', ['messages' => $errors->get('name')])
            </div>
            <div class="flex flex-col mt-6">
                <h1 class="font-bold">Role Permissions</h1>
                @if ($features->count())
                @foreach ($features as $feature)
                    <div class="flex flex-row mt-2 w-full">
                            <h3 class="w-1/4">{{$feature->name}}</h3>
                            <div class="w-full flex justify-start">
                                @if ($feature->permissions->count())
                                    @foreach ($feature->permissions as $permission)
                                    <div class="w-1/6">
                                        <label for="{{$permission->id}}" class="flex items-center">
                                            <input type="checkbox" id="{{$permission->id}}" name="permissions[]" class="mr-2" value="{{$permission->id}}"
                                            @if($role->permissions->contains('id', $permission->id)) checked @endif>
                                                {{$permission->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                    @include('components.form.error', ['messages' => $errors->get('permissions')])
                                @endif
                            </div>
                    </div>
                @endforeach 
                @else
                    
                @endif
            </div>
        </div>
        <!-- submit button-->
        <div class="mt-6 flex justify-center">
            <x-button type="submit" variant="primary" size="base">
                CREATE
            </x-button>
        </div>
    </form>
</x-app-layout>
