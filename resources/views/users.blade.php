<x-app-layout>
    <div class="pb-6 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex" style="flex-direction: column;gap: 1rem;">
                    <h2 class="pb-6 text-lg font-medium text-gray-900">Пользователи</h2>
                    @foreach($users as $user)
                        <a href="{{ route('view-posts', ['user' => $user->id]) }}" class="p-4" style="width: 23rem;cursor: pointer;border-radius: .5rem;box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5), -1px -1px 4px rgba(255, 255, 255, 0.1);">
                            <div><span>Имя: </span><span>{{ $user->name }} </span></div>
                            <div><span>Email: </span><span>{{ $user->email }}</span></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
