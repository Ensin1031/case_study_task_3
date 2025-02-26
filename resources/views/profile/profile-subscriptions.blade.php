<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Мои подписки') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Пользователи, на которых вы подписаны.") }}
        </p>
    </header>

    <div class="flex flex-wrap" style="gap: 1rem;">

        @foreach($user->user_subscriptions as $subscription)
            <div class="p-4" style="width: 23rem;cursor: pointer;border-radius: .5rem;box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5), -1px -1px 4px rgba(255, 255, 255, 0.1);">
                <div><span>Имя: </span><span>{{ $subscription->name }} </span></div>
                <div><span>Email: </span><span>{{ $subscription->email }}</span></div>
            </div>
        @endforeach

    </div>
</section>
