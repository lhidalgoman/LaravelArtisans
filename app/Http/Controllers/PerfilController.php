<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PerfilController extends Controller
{
    // Resto del código del controlador
    public function show()
    {
        $user = Auth::user();
        return view('perfil', compact('user'));
    }
    // public function cambiarContrasena(Request $request)
    // {
    //     $user = Auth::user();
    //     $currentPassword = $request->input('current_password');
    //     $newPassword = $request->input('new_password');

    //     // Verificar que la contraseña actual sea correcta
    //     if (!Hash::check($currentPassword, $user->password)) {
    //         return redirect()->back()->with('error', 'La contraseña actual es incorrecta.');
    //     }

    //     // Actualizar la contraseña
    //     $user->password = Hash::make($newPassword);
    //     $user->save();

    //     return redirect()->back()->with('success', 'La contraseña se ha actualizado correctamente.');
    // }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // Verificar si se proporcionó una nueva contraseña
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return redirect()->back()->with('success', 'Los cambios se han guardado correctamente.');
    }
}
