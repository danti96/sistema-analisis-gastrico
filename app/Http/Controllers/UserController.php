<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function editPermissions(User $user)
    {
        $permissions = Permission::all();
        return view('users.permissions', compact('user', 'permissions'));
    }

    public function updatePermissions(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions ?? []);
        return redirect()->route('users.permissions.edit', $user)->with('success', 'Permisos actualizados.');
    }
    // Listar usuarios
    public function index()
    {
        $users = User::paginate(10);
        return view('permissions.users.index', compact('users'));
    }

    // Mostrar formulario para crear usuario
    public function create()
    {
        return view('permissions.users.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado.');
    }

    // Mostrar formulario para editar usuario
    public function edit(User $user)
    {
        return view('permissions.users.edit', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado.');
    }

    // Mostrar formulario para asignar roles
    public function editRoles(User $user)
    {
        $roles = Role::all();
        return view('permissions.users.roles', compact('user', 'roles'));
    }

    // Guardar roles asignados al usuario
    public function updateRoles(Request $request, User $user)
    {
        $user->syncRoles($request->roles ?? []);
        return redirect()->route('users.roles.edit', $user)->with('success', 'Roles actualizados.');
    }
}
