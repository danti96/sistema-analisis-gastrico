<x-app-layout>

    <nav class="bg-gray-800 p-4 text-white flex space-x-4">
        <a href="{{ route('users.index') }}" class="hover:underline">Usuarios</a>
        <a href="{{ route('roles.index') }}" class="hover:underline">Roles</a>
        <a href="{{ route('permissions.index') }}" class="hover:underline">Permisos</a>
    </nav>    <div class="container mx-auto p-4 max-w-md">
        <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')

            <label for="name" class="block mb-2 font-bold">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="border border-gray-300 rounded px-3 py-2 w-full" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="email" class="block mt-4 mb-2 font-bold">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="border border-gray-300 rounded px-3 py-2 w-full" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="password" class="block mt-4 mb-2 font-bold">Nueva Contraseña (opcional)</label>
            <input type="password" name="password" id="password"
                class="border border-gray-300 rounded px-3 py-2 w-full">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="password_confirmation" class="block mt-4 mb-2 font-bold">Confirmar Nueva Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="border border-gray-300 rounded px-3 py-2 w-full">

            <button type="submit" class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Actualizar
            </button>
        </form>
    </div>
</x-app-layout>
