<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//Controller para el perfil del usuario de la app
class PerfilController extends Controller
{
    // Mostrar el perfil del usuario
    public function show()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        return view('perfil', compact('user'));
    }

    // Actualizar la información del perfil del usuario
    public function update(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Validar los datos del formulario de actualización
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Actualizar los datos del usuario con la información proporcionada en el formulario
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // Verificar si se proporcionó una nueva contraseña y encriptarla
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        
        // Guardar los cambios en el usuario
        $user->save();

        return redirect()->back()->with('success', 'Los cambios se han guardado correctamente.');
    }
}