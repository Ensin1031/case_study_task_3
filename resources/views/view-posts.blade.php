<x-app-layout>
    <x-slot name="header">
        <form method="GET" action="{{ route('view-posts') }}">
            <div class="flex items-center">
                <div class="flex items-center">
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-input-label for="user" :value="'Пользователь: '" class="mr-4 text-lg font-medium text-gray-900"/>
                        <div style="width: 23rem;">
                            <select name="user" id="user" class="block w-full" style="border-radius: 5px;border: 1px solid rgb(209 213 219 / var(--tw-border-opacity, 1))">
                                <option value="">------------</option>
                                @foreach($users as $user)
                                    @if ($user->id == $user_id)
                                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-input-label for="user" :value="'Тег: '" class="mr-4 text-lg font-medium text-gray-900"/>
                        <div style="width: 23rem;">
                            <select name="tag" id="tag" class="block w-full" style="border-radius: 5px;border: 1px solid rgb(209 213 219 / var(--tw-border-opacity, 1))">
                                <option value="">------------</option>
                                @foreach($tags as $tag)
                                    @if ($tag->id == $tag_id)
                                        <option value="{{ $tag->id }}" selected>{{ $tag->title }}</option>
                                    @else
                                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-primary-button class="ms-4">
                        {{ __('Поиск') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </x-slot>

    <div class="pb-6 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex" style="flex-direction: column;gap: 1rem;">
                    <h2 class="pb-6 text-lg font-medium text-gray-900">Опубликованные посты</h2>
                    @foreach($posts as $post)
                        <x-post-card
                            :post="$post"
                            :can_edit="Auth::user()->id == $post->user_id"
                            :need_tags="true"
                            :redirect_to="'view-posts'"
                            :query_parameters="[
                                'user' => array_key_exists('user', request()->query()) ? request()->query()['user'] : '',
                                'tag' => array_key_exists('tag', request()->query()) ? request()->query()['tag'] : '',
                            ]"
                            class="mt-2"
                        />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
