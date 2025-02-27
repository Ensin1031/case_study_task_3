<x-app-layout>
    <div class="pb-6 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex" style="flex-direction: column;gap: 1rem;">
                    <h2 class="pb-6 text-lg font-medium text-gray-900">Пользователи</h2>
                    @foreach($users as $user)
                        <x-user-card :user="$user" :redirect_to="'user-subscriptions'"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
