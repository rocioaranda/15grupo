<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacionController extends Controller
{
    /**
     * Muestra el formulario de registro.
     */
    public function formularioRegistro()
    {
        return view('backend.usuarios.registro'); 
    }

    /**
     * Procesa el formulario de registro ENCRIPTANDO la contraseña.
     */
    public function registrar(Request $request)
    {
        $request->validate([
            'nombre_apellido' => 'required|string|max:255',
            'email'           => 'required|email|unique:usuarios,email',
            'telefono'        => 'required|string|max:20', 
            'password'        => 'required|min:8|confirmed',
        ]);

        $rol = \App\Models\Rol::firstOrCreate(
            ['nombre' => 'Cliente']
        );

        // Guardamos al usuario y ENCRIPTAMOS su password con bcrypt()
        $usuario = Usuario::create([
            'nombre_apellido' => $request->nombre_apellido,
            'email'           => $request->email,
            'telefono'        => $request->telefono,
            'password'        => bcrypt($request->password), // <-- ENCRIPTA LA CONTRASEÑA
            'rol_id'          => $rol->id, 
        ]);

        Auth::login($usuario);

        return redirect('/')->with('exito', '¡Cuenta creada con éxito!');
    }

    /**
     * Muestra el formulario de Login.
     */
    public function formularioLogin()
    {
        return view('backend.usuarios.login'); 
    }

    /**
     * Procesa el inicio de sesión COMPARANDO las contraseñas de forma segura.
     */
    public function login(Request $request)
    {
        // 1. Validamos que el email y password ingresados tengan un formato correcto
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // login con las credenciales directamente
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        // 2. Usamos Auth::attempt()
        // Lo que hace Laravel acá de forma automática es:
        //   - Busca al usuario por su 'email'.
        //   - Toma la 'password' que escribió el usuario en texto plano, la encripta internamente
        //     y la compara con el "hash" (código encriptado) que está guardado en la base de datos.
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            
            $request->session()->regenerate();

            if (Auth::user()->rol_id === 1) {
                return redirect()->intended('/admin')->with('exito', '¡Bienvenido Administrador!');
            }

            return redirect()->intended('/mi-perfil')->with('exito', '¡Qué bueno verte de nuevo!');
        }

        // 3. Si no coinciden las credenciales, rebota con error
        return back()->withErrors([
            'email' => 'Las credenciales ingresadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('exito', 'Sesión cerrada correctamente.');
    }
}
           /**busca el rol en la tabla roles y si no existe lo crea 
        despues sigue usuario create y se repite los datos del formulario
        luego redirecciona el login con un mensaje exitoso 
        muestra el formulario de login despues debemos autenticar los datos*/

