@props(['user', 'width' => '100%', 'redirect_to', 'query_parameters' => [], 'need_row_prefix' => true, 'id_prefix' => 0, 'need_shadow' => true, 'need_padding' => true])

@if ($user)
    <div class="{{ !!$need_padding ? 'p-4' : '' }}" style="width: {{$width}};border-radius: .5rem;box-shadow: {{ !!$need_shadow ? '1px 1px 4px rgba(0, 0, 0, 0.5), -1px -1px 4px rgba(255, 255, 255, 0.1)' : 'none' }};">
        <a href="{{ route('view-posts', ['user' => $user->id]) }}" target="_blank">
            <div class="flex" style="gap: .5rem;">
                @if ($need_row_prefix)
                    <span>Имя: </span>
                @endif
                <span>{{ $user->name }} </span>
            </div>
            <div class="flex" style="gap: .5rem;">
                @if ($need_row_prefix)
                    <span>Email: </span>
                @endif
                <span>{{ $user->email }}</span>
            </div>
        </a>
        <div class="flex mt-2">
            @if (Auth::user()->is_user_sub($user))
                <x-danger-button
                    class="{{ !$need_padding ? 'ml-4' : '' }}"
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'destroy-this-user-sub-{{$id_prefix}}-{{Auth::user()->id}}-{{$user->id}}')"
                >Отписаться</x-danger-button>
                <x-modal name="destroy-this-user-sub-{{$id_prefix}}-{{Auth::user()->id}}-{{$user->id}}" focusable>
                    <form method="post" action="{{ route('user-sub.destroy', ['redirect_to' => $redirect_to, 'yyyy' => 23, 'query_parameters' => $query_parameters]) }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900">
                            Отписаться от пользователя {{ $user->name }} ({{ $user->email }})?
                        </h2>

                        <!-- id -->
                        <div class="mt-4" style="display: none;">
                            <x-text-input id="subscription_user_id" type="number" name="subscription_user_id" :value="$user->id" required/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Отмена') }}
                            </x-secondary-button>
                            <x-primary-button class="ms-4">
                                {{ __('Отписаться') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-modal>
            @elseif(!(Auth::user()->is_user_sub($user)) && !(Auth::user()->id === $user->id))
                <x-secondary-button
                    class="{{ !$need_padding ? 'ml-4' : '' }}"
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'create-this-user-sub-{{$id_prefix}}-{{Auth::user()->id}}-{{$user->id}}')"
                >Подписаться</x-secondary-button>
                <x-modal name="create-this-user-sub-{{$id_prefix}}-{{Auth::user()->id}}-{{$user->id}}" focusable>
                    <form method="post" action="{{ route('user-sub.create', ['redirect_to' => $redirect_to, 'yyyy' => 23, 'query_parameters' => $query_parameters]) }}" class="p-6">
                        @csrf
                        @method('post')

                        <h2 class="text-lg font-medium text-gray-900">
                            Подписаться на пользователя {{ $user->name }} ({{ $user->email }})?
                        </h2>

                        <!-- id -->
                        <div class="mt-4" style="display: none;">
                            <x-text-input id="subscription_user_id" type="number" name="subscription_user_id" :value="$user->id" required/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Отмена') }}
                            </x-secondary-button>
                            <x-primary-button class="ms-4">
                                {{ __('Подписаться') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-modal>
            @endif
        </div>
    </div>
@endif
