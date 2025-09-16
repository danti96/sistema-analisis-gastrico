<x-app-layout>

    <nav class="bg-gray-800 p-4 text-white flex space-x-4">
        <a href="{{ route('users.index') }}" class="hover:underline">Usuarios</a>
        <a href="{{ route('roles.index') }}" class="hover:underline">Roles</a>
        <a href="{{ route('permissions.index') }}" class="hover:underline">Permisos</a>
    </nav>
    <div class="container mx-auto p-4 max-w-lg">
        <h1 class="text-2xl font-bold mb-4">Roles para {{ $user->name }}</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('users.roles.update', $user) }}">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                @foreach ($roles as $role)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="roles[]" value="{{ $role->name }}" class="form-checkbox"
                            {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $role->name }}</span>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="mt-4 bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">
                Guardar roles
            </button>
        </form>
    </div>
</x-app-layout>
