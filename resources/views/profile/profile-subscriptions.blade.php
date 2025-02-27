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
            <x-user-card :user="$subscription" :width="'23rem'" :redirect_to="'profile.edit'"/>
        @endforeach

    </div>
</section>
