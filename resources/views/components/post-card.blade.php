@props(['post', 'can_edit'])

@if ($post)
    <div class="p-4" style="width: 100%;border-radius: .5rem;box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5), -1px -1px 4px rgba(255, 255, 255, 0.1);">
        <div class="flex justify-between" style="gap: 1rem;">
            <div>
                <h2 class="pb-4 text-lg font-medium text-gray-900">{{ $post->title }} - {{ $post->id }} - {{ count($post->child_posts) }}</h2>
                <div class="pb-4">{{ $post->description }}</div>
            </div>
            <div class="flex" style="flex-direction: column;gap: 1rem;">
                <button class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Комментировать') }}
                </button>
                @if ($can_edit)

                    <x-primary-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'update-user-post-{{$post->id}}')"
                    >{{ __('Редактировать') }}
                    </x-primary-button>

                    <x-danger-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'delete-user-post-{{$post->id}}')"
                    >{{ __('Удалить') }}
                    </x-danger-button>

                    <x-modal name="update-user-post-{{$post->id}}" focusable>
                        <form method="post" action="{{ route('personal-blog.update') }}" class="p-6">
                            @csrf
                            @method('patch')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Изменить пост') }}
                            </h2>

                            <!-- title -->
                            <div class="mt-4">
                                <x-input-label for="title" :value="__('Заголовок')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$post->title" required autofocus autocomplete="title" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- description -->
                            <div class="mt-4">
                                <x-input-label for="description" :value="__('Пост')" />
                                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$post->description" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- is_public -->
                            <div class="mt-4">
                                <label for="is_public_update" class="inline-flex items-center">
                                    <input id="is_public_update" type="checkbox" :value="{{!!($post->is_public)}}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_public">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Публичный пост') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __('Изменить') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                    <x-modal name="delete-user-post-{{$post->id}}" focusable>
                        <form method="post" action="{{ route('personal-blog.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Изменить пост') }}
                            </h2>

                            <!-- title -->
                            <div class="mt-4">
                                <x-input-label for="title" :value="__('Заголовок')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$post->title" required autofocus autocomplete="title" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- description -->
                            <div class="mt-4">
                                <x-input-label for="description" :value="__('Пост')" />
                                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$post->description" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- is_public -->
                            <div class="mt-4">
                                <label for="is_public_update" class="inline-flex items-center">
                                    <input id="is_public_update" type="checkbox" :value="{{!!($post->is_public)}}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_public">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Публичный пост') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __('Изменить') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                @endif
            </div>
        </div>
        @if(count($post->child_posts) > 0)
            <div class="flex justify-between">
                <details style="width: 100%;">
                    <summary style="cursor: pointer;" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Комментарии ({{ count($post->child_posts) }})</summary>
                    <div class="flex mt-4" style="flex-direction: column;gap: 1rem;">
                        @foreach($post->child_posts as $child_post)
                            <x-post-card :post="$child_post" :can_edit="Auth::user()->id == $child_post->user_id" class="mt-2"/>
                        @endforeach
                    </div>
                </details>
            </div>
        @endif
    </div>
@endif
