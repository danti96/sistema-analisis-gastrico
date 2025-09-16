

<x-app-layout>
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Permisos para {{ $user->name }}</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('users.permissions.update', $user) }}">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            @foreach($permissions as $permission)
                <label class="inline-flex items-center">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-checkbox"
                        {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                    <span class="ml-2">{{ $permission->name }}</span>
                </label>
            @endforeach
        </div>

        <button type="submit" class="mt-4 bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">
            Guardar permisos
        </button>
    </form>
</div>
</x-app-layout>
