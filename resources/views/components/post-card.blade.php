@props(['post', 'can_edit', 'need_tags', 'redirect_to', 'query_parameters' => []])

@if ($post)
    <div class="p-4" style="width: 100%;border-radius: .5rem;box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5), -1px -1px 4px rgba(255, 255, 255, 0.1);">
        <div class="flex justify-between" style="gap: 1rem;">
            <div>
                <h2 class="pb-4 text-lg font-medium text-gray-900">{{ $post->title }} - {{ $post->id }} - {{str($post->is_public)}}</h2>
                <div class="pb-4">{{ $post->description }}</div>
                @if ($need_tags)
                    <div class="pb-4 flex flex-wrap" style="gap: .5rem;">
                        <div>
                            <span>Теги поста: </span>
                            @if ($can_edit)
                                <x-primary-button
                                    style="padding: 0 !important;margin: 0 !important;width: 1.2rem;height: 1.2rem;"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'create-post-tag-sub-{{$post->id}}')"
                                >+</x-primary-button>
                                <x-modal name="create-post-tag-sub-{{$post->id}}" focusable>
                                    <form method="post" action="{{ route('post-tag-sub.create', ['redirect_to' => $redirect_to, 'yyyy' => 23, 'query_parameters' => $query_parameters]) }}" class="p-6">
                                        @csrf
                                        @method('post')

                                        <h2 class="text-lg font-medium text-gray-900">
                                            {{ __('Установить тег поста') }}
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600">
                                            <span>Вы устанавливаете тег к сообщению: </span><span class="text-gray-900">{{ $post->description }}</span>
                                        </p>

                                        <!-- id -->
                                        <div class="mt-4" style="display: none;">
                                            <x-text-input id="post_id" type="number" name="post_id" :value="$post->id" required/>
                                        </div>

                                        <!-- title -->
                                        <div class="mt-4">
                                            <x-input-label for="title" :value="__('Тег')" />
                                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus autocomplete="title" />
                                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Отмена') }}
                                            </x-secondary-button>
                                            <x-primary-button class="ms-4">
                                                {{ __('Установить тег поста') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </x-modal>
                            @endif
                        </div>
                        @foreach($post->tags as $tag)
                            <div>
                                <a href="{{ route('view-posts', ['tag' => $tag->id, 'user' => $post->user_id]) }}" target="_blank" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    #{{ $tag->title }}
                                </a>
                                @if ($can_edit)
                                    <x-danger-button
                                        style="padding: 0 !important;margin: 0 !important;width: 1.2rem;height: 1.2rem;"
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'delete-post-tag-sub-{{$tag->id}}')"
                                    >-</x-danger-button>
                                    <x-modal name="delete-post-tag-sub-{{$tag->id}}" focusable>
                                        <form method="post" action="{{ route('post-tag-sub.destroy', ['redirect_to' => $redirect_to, 'query_parameters' => $query_parameters]) }}" class="p-6">
                                            @csrf
                                            @method('delete')

                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Вы уверены, что хотите удалить этот тег поста?') }}
                                            </h2>

                                            <!-- id -->
                                            <div class="mt-4" style="display: none;">
                                                <x-text-input id="tag_id" type="number" name="tag_id" :value="$tag->id" required/>
                                            </div>

                                            <!-- id -->
                                            <div class="mt-4" style="display: none;">
                                                <x-text-input id="post_id" type="number" name="post_id" :value="$post->id" required/>
                                            </div>

                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Отмена') }}
                                                </x-secondary-button>
                                                <x-danger-button class="ms-3">
                                                    {{ __('Удалить тег поста') }}
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="flex" style="flex-direction: column;gap: 1rem;">

                <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'create-comment-user-post-{{$post->id}}')"
                >{{ __('Комментировать') }}
                </x-primary-button>
                <x-modal name="create-comment-user-post-{{$post->id}}" focusable>
                    <form method="post" action="{{ route('personal-blog.create', ['redirect_to' => $redirect_to, 'query_parameters' => $query_parameters]) }}" class="p-6">
                        @csrf
                        @method('post')

                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Комментировать пост') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            <span>Вы комментируете сообщение: </span><span class="text-gray-900">{{ $post->description }}</span>
                        </p>

                        <!-- id -->
                        <div class="mt-4" style="display: none;">
                            <x-text-input id="post_id" type="number" name="post_id" :value="$post->id" required/>
                        </div>

                        <!-- title -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Заголовок')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Пост')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Отмена') }}
                            </x-secondary-button>
                            <x-primary-button class="ms-4">
                                {{ __('Оставить комментарий') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-modal>
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
                        <form method="post" action="{{ route('personal-blog.update', ['redirect_to' => $redirect_to, 'query_parameters' => $query_parameters]) }}" class="p-6">
                            @csrf
                            @method('patch')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Изменить пост') }}
                            </h2>

                            <!-- id -->
                            <div class="mt-4" style="display: none;">
                                <x-text-input id="id" type="number" name="id" :value="$post->id" required/>
                            </div>

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
                                    @if ($post->is_public === 1)
                                        <input id="is_public_update" type="checkbox"  checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_public">
                                    @else
                                        <input id="is_public_update" type="checkbox" {{ old('is_public_update') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_public">
                                    @endif
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Публичный пост') }} - {{$post->is_public}}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Отмена') }}
                                </x-secondary-button>
                                <x-primary-button class="ms-4">
                                    {{ __('Изменить') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                    <x-modal name="delete-user-post-{{$post->id}}" focusable>
                        <form method="post" action="{{ route('personal-blog.destroy', ['redirect_to' => $redirect_to, 'query_parameters' => $query_parameters]) }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Вы уверены, что хотите удалить этот пост?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('При удалении поста так-же станут недоступными комментарии к нему.') }}
                            </p>

                            <!-- id -->
                            <div class="mt-4" style="display: none;">
                                <x-text-input id="id" type="number" name="id" :value="$post->id" required/>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Отмена') }}
                                </x-secondary-button>
                                <x-danger-button class="ms-3">
                                    {{ __('Удалить пост') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                @endif
            </div>
        </div>
        <div class="flex justify-between">
            <details style="width: 100%;">
                <summary style="cursor: pointer;" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Комментарии ({{ count($post->child_posts) }})</summary>
                @if (count($post->child_posts) > 0)
                    <div class="flex mt-4" style="flex-direction: column;gap: 1rem;">
                        @foreach($post->child_posts as $child_post)
                            <x-post-card :post="$child_post" :can_edit="Auth::user()->id == $child_post->user_id" :need_tags="false" :redirect_to="$redirect_to" :query_parameters="$query_parameters" class="mt-2"/>
                        @endforeach
                    </div>
                @endif
            </details>
        </div>
    </div>
@endif
