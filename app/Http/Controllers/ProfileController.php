<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Validar la imagen si se sube
        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // El nombre del input del formulario puede seguir siendo 'profile_photo'
        ]);

        // Actualizar los datos básicos del perfil
        // Asegúrate de que 'photo' no esté en $request->validated() si lo manejas por separado
        // o que el input 'profile_photo' del formulario no interfiera aquí si 'photo' es un campo esperado en validated().
        // Si ProfileUpdateRequest incluye 'photo', podría causar un conflicto.
        // Es más seguro llenar los campos uno por uno o excluír 'photo' del fill y asignarlo después.
        
        $userData = $request->validated();
        // Si 'photo' está en validated y es la ruta de la imagen, esto es incorrecto.
        // El campo 'profile_photo' es el archivo subido.
        // Vamos a llenar sólo los campos que no son la foto primero.
        $user->fill($request->except('profile_photo'));


        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Manejar la imagen de perfil
        if ($request->hasFile('profile_photo')) {
            // Eliminar la imagen anterior si existe
            if ($user->photo) { // Cambiado de profile_photo_path a photo
                $oldImagePath = public_path($user->photo); // Cambiado de profile_photo_path a photo
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('profile_photo');
            $extension = $image->getClientOriginalExtension();
            $safeName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
            $imageName = time() . '_' . $safeName . '.' . $extension;
            
            // Mover la imagen al directorio de fotos de perfil
            $image->move(public_path('storage/profilePhoto'), $imageName);
            
            // Guardar la ruta en la base de datos
            $user->photo = 'storage/profilePhoto/' . $imageName; // Cambiado de profile_photo_path a photo
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Eliminar la foto de perfil si existe
        if ($user->photo) { // Cambiado de profile_photo_path a photo
            $oldImagePath = public_path($user->photo); // Cambiado de profile_photo_path a photo
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = $request->user();

        if ($request->hasFile('profile_photo')) {
            // Eliminar la imagen anterior si existe
            if ($user->photo) { // Cambiado de profile_photo_path a photo
                $oldImagePath = public_path($user->photo); // Cambiado de profile_photo_path a photo
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('profile_photo');
            $extension = $image->getClientOriginalExtension();
            $safeName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
            $imageName = time() . '_' . $safeName . '.' . $extension;
            
            // Mover la imagen al directorio de fotos de perfil
            $image->move(public_path('storage/profilePhoto'), $imageName);
            
            // Guardar la ruta en la base de datos
            $user->photo = 'storage/profilePhoto/' . $imageName; // Cambiado de profile_photo_path a photo
            $user->save();
        }

        return back()->with('status', 'profile-photo-updated');
    }
}