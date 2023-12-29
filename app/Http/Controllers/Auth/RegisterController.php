<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Persona; // Agrega esta línea para incluir el modelo Persona
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // Dividir el nombre en partes
        $nameParts = explode(' ', $data['name']);

        // Crear una nueva instancia de Persona y guardarla en la base de datos
        $persona = new Persona([
            'Nombre'   => $nameParts[0] ?? null,
            'Apellido1' => $nameParts[1] ?? null,
            'Apellido2' => $nameParts[2] ?? null,
        ]);
        $persona->save();

        // Crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Asignar el rol 'user' al nuevo usuario
        $user->assignRole('user');

        return $user;
    }
}
