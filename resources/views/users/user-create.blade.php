<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create New User') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden ">
        <form action="{{route('users.create')}}" method="POST">
            @csrf
            <div class="flex justify-between flex-grow h-auto">
                <div class="items-center w-1/2 text-left bg-white rounded-md shadow-md dark:bg-dark-eval-1 mr-2">
                    <div class="ml-2">
                        <h1 class="text-lg mt-4 mb-4">User Information</h1>

                        <!-- Name -->
                        <div class="mt-4 flex flex-row items-center">
                            <x-form.label
                                for="name"
                                :value="__('Name : ')"
                                class="w-1/3"
                            />
        
                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                                </x-slot>
        
                                <x-form.input
                                    withicon
                                    id="name"
                                    class="block w-full"
                                    type="text"
                                    name="name"
                                    :value="old('name')"
                                    required
                                    autofocus
                                    placeholder="{{ __('Name') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                        </div>

                        <!-- User Name -->
                        <div class="mt-4 flex flex-row items-center">
                            <x-form.label
                                for="username"
                                :value="__('User Name : ')"
                                class="w-1/3"
                            />
        
                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                                </x-slot>
        
                                <x-form.input
                                    withicon
                                    id="username"
                                    class="block w-full"
                                    type="text"
                                    name="username"
                                    :value="old('username')"
                                    required
                                    autofocus
                                    placeholder="{{ __('User Name') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                        </div>
                        
                        <!-- Phone Number -->
                        <div class="mt-4 flex flex-row items-center">
                            <x-form.label
                                for="phone"
                                :value="__('Phone No : ')"
                                class="w-1/3"
                            />
        
                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-phone aria-hidden="true" class="w-5 h-5" />
                                </x-slot>
        
                                <x-form.input
                                    withicon
                                    id="phone"
                                    class="block w-full"
                                    type="text"
                                    name="phone"
                                    :value="old('phone')"
                                    required
                                    autofocus
                                    placeholder="{{ __('Phone Number') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                        </div>

                        <!-- Email -->
                        <div class="mt-4 flex flex-row items-center">
                            <x-form.label
                                for="email"
                                :value="__('Email : ')"
                                class="w-1/3"
                            />
        
                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                                </x-slot>
        
                                <x-form.input
                                    withicon
                                    id="email"
                                    class="block w-full"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    autofocus
                                    placeholder="{{ __('Email') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                        </div>

                        <!-- Address -->
                        <div class="mt-4 flex flex-row items-center">
                            <x-form.label
                                for="address"
                                :value="__('Address : ')"
                                class="w-1/3"
                            />
        
                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-map aria-hidden="true" class="w-5 h-5" />
                                </x-slot>
        
                                <x-form.input
                                    withicon
                                    id="address"
                                    class="block w-full"
                                    type="text"
                                    name="address"
                                    :value="old('address')"
                                    required
                                    autofocus
                                    placeholder="{{ __('Address') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                        </div>

                        <!-- Gender -->
                        <div class="mt-4 flex flex-row items-center mb-4">
                            <x-form.label
                                for="gender"
                                :value="__('Gender : ')"
                                class="w-1/3"
                            />

                            <div class="flex items-center">
                                <input id="female" type="radio" class="form-radio text-green-600 h-3 w-3" name="gender" value="0">
                                <x-form.label for="female" :value="__('Female')" class="ml-2 mr-6" />
                        
                                <input id="male" type="radio" class="form-radio text-green-600 h-3 w-3" name="gender" value="1">
                                <x-form.label for="male" :value="__('Male')" class="ml-2" />
                            </div>
                        </div>

                        <!-- is active -->
                        <div class="mt-4 flex flex-row items-center mb-4">
                            <x-form.label
                                for="is_active"
                                :value="__('Is Active : ')"
                                class="w-1/3"
                            />

                            <input id="is_active" type="checkbox" class="text-purple-600 h-4 w-4" name="is_active">
                        </div>

                    </div>
                </div>
                <div class="items-center w-1/2 text-left bg-white rounded-md shadow-md dark:bg-dark-eval-1 ml-2">
                    <div class="ml-2">
                        <h1 class="text-lg mt-4 mb-4">Roles & Permission</h1>

                        <!-- role -->
                        <div class="mt-4 flex flex-row items-center">
                            <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white w-1/2">Role : </label>
                            <select id="role_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500 mr-20">
                                <option selected value="">Choose a Role</option>
                                @foreach ($roles as $role)
                                    <option selected value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Password -->
                        <div class="mt-4 flex flex-row items-center">
                            <x-form.label
                                for="password"
                                :value="__('Password : ')"
                                class="w-1/3"
                            />
        
                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-eye aria-hidden="true" class="w-5 h-5" />
                                </x-slot>
        
                                <x-form.input
                                    withicon
                                    id="password"
                                    class="block w-full"
                                    type="password"
                                    name="password"
                                    required
                                    autofocus
                                    placeholder="{{ __('Password') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                        </div>

                        <!-- Password Confirmed-->
                        <div class="mt-4 flex flex-row items-center">
                            <x-form.label
                                for="password_confirmation"
                                :value="__('Confirm Password : ')"
                                class="w-1/3"
                            />
        
                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-eye aria-hidden="true" class="w-5 h-5" />
                                </x-slot>
        
                                <x-form.input
                                    withicon
                                    id="password_confirmation"
                                    class="block w-full"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autofocus
                                    placeholder="{{ __('Confirm Password') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                        </div>

                    </div>
                </div>
            </div>

            <!-- submit and cancel buttons-->
            <div class="flex w-full justify-between mt-6">
                <div class="w-1/2 text-center">
                    <x-button href="{{ route('users.list') }}" variant="secondary" size="base">
                        Cancel
                    </x-button>            
                </div>
                <div class="w-1/2 text-center">
                    <x-button type="submit" variant="primary" size="base">
                        CREATE
                    </x-button>
                </div>
            </div>
        </form>
    </div>
    
</x-app-layout>
