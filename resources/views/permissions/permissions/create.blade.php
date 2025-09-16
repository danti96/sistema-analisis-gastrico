

<x-app-layout>
    <nav class="bg-gray-800 p-4 text-white flex space-x-4">
        <a href="{{ route('users.index') }}" class="hover:underline">Usuarios</a>
        <a href="{{ route('roles.index') }}" class="hover:underline">Roles</a>
        <a href="{{ route('permissions.index') }}" class="hover:underline">Permisos</a>
    </nav>
<div class="container mx-auto p-4 max-w-md">
    <h1 class="text-2xl font-bold mb-4">{{ isset($permission) ? 'Editar' : 'Crear' }} Permiso</h1>

    <form method="POST" action="{{ isset($permission) ? route('permissions.update', $permission) : route('permissions.store') }}">
        @csrf
        @if(isset($permission))
            @method('PUT')
        @endif

        <label class="block mb-2 font-bold" for="name">Nombre</label>
        <input type="text" name="name" id="name" value="{{ old('name', $permission->name ?? '') }}" class="border border-gray-300 rounded px-3 py-2 w-full" required>
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ isset($permission) ? 'Actualizar' : 'Guardar' }}
        </button>
    </form>
</div>
</x-app-layout>
