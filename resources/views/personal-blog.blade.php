<x-app-layout>
    <div class="pb-6 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="pb-6 text-lg font-medium text-gray-900">Добавить пост</h2>
                    <form method="POST" action="{{ route('personal-blog.create') }}">
                        @csrf
                        @method('post')

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
                                <input id="is_public_create" type="checkbox" {{ old('is_public_create') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_public">
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
                    <h2 class="pb-6 text-lg font-medium text-gray-900">Опубликованные посты</h2>
                    @foreach($posts as $post)
                        <x-post-card :post="$post" :can_edit="Auth::user()->id == $post->user_id" :need_tags="true" :redirect_to="'personal-blog'" class="mt-2"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
