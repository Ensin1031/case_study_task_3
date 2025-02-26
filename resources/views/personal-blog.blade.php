<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Личный Блог') }}
            </h2>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>Посты по категориям</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Профиль1') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Профиль2') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>Посты по тегам</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Профиль1') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Профиль2') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </x-slot>

    <div class="pb-6 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="pb-6 text-lg font-medium text-gray-900">Добавить пост</h2>
                    <form method="POST" action="{{ route('create-post') }}">
                        @csrf
                        @method('post')

{{--                        <div class="mt-4">--}}
{{--                            <x-input-label for="category_id" :value="__('Категория поста')" />--}}
{{--                            <select name="category_id" id="category_id" class="block mt-1 w-full" style="border-radius: 5px;border: 1px solid rgb(209 213 219 / var(--tw-border-opacity, 1))">--}}
{{--                                @foreach($categories as $category)--}}
{{--                                    <option value="{{ $category->id }}">{{ $category->title }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        <!-- title -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Заголовок')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Пост')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- is_public -->
                        <div class="mt-4">
                            <label for="is_public_create" class="inline-flex items-center">
                                <input id="is_public_create" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_public">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Публичный пост') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Разместить') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex" style="flex-direction: column;gap: 1rem;">
                    <h2 class="pb-6">Опубликованные посты</h2>
                    @foreach($posts as $post)
                        <x-post-card :post="$post" :can_edit="Auth::user()->id == $post->user_id" class="mt-2"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
