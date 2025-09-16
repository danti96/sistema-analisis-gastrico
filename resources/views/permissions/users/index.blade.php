<x-app-layout>
    <nav class="bg-gray-800 p-4 text-white flex space-x-4">
        <a href="{{ route('users.index') }}" class="hover:underline">Usuarios</a>
        <a href="{{ route('roles.index') }}" class="hover:underline">Roles</a>
        <a href="{{ route('permissions.index') }}" class="hover:underline">Permisos</a>
    </nav>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Usuarios</h1>

        <a href="{{ route('users.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Crear
            Usuario</a>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Nombre</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                            <a href="{{ route('users.edit', $user) }}"
                                class="bg-yellow-400 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded">Editar</a>

                            <a href="{{ route('users.roles.edit', $user) }}"
                                class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-1 px-3 rounded">Roles</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border border-gray-300 px-4 py-2 text-center">No hay usuarios.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
