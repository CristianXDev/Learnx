<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class profileController extends Controller{


    public function update(Request $request){

        //Guardar id del usuario
        $id = $request['id'];

        // Find the user to update
        $user = User::findOrFail($id); 

        if($user){

        // Validate the incoming data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:20',
                'lastname' => 'required|string|max:20',
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);

        // If validation fails, return an error response
            if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput(); // Devuelve todos los valores anteriores
       }

        // Update the user's data
       $user->name = $request->input('name');
       $user->lastname = $request->input('lastname');
       $user->email = $request->input('email');

        // Save the changes to the database
       $user->save();

        // Return a success response with the updated user data
       return redirect()->route('profile')->with('success', 'Sus información ha sido actualizada.');
   } else{

    // Return a success response with the updated user data
     return redirect()->route('profile')->withErrors('Usuario no encontrado');

    }
}

    public function update_photo(Request $request){

        // 1. Validation
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
       }

        //Guardar id del usuario
       $id = $request['id'];

        // Find the user to update
       $user = User::findOrFail($id); 

       if($user){


        $user = User::findOrFail($id);

        // 3. Delete the old image if it exists
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        // 4. Upload the new image
        $photoPath = $request->file('image')->store('public/user_photos');

        // 5. Update the user's photo attribute
        $user->image = $photoPath;
        $user->save();

        // 6. Return success response
        return redirect()->route('profile')->with('success', 'Su foto de perfil ha sido actualizada');

    }else{

       // Return a success response with the updated user data
        return redirect()->route('profile')->withErrors('Usuario no encontrado');
    }
}

    public function update_password(Request $request){

        //Guardar id del usuario
       $id = $request['id'];

        // Find the user to update
       $user = User::findOrFail($id); 

       if($user){

        // 1. Validation
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 2. Find the user
        $user = User::findOrFail($id);

        // 3. Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            // Return a success response with the updated user data
            return redirect()->route('profile')->withErrors('La contraseña actual no es correcta');
        }

        // 4. Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // 5. Return success response
        return redirect()->route('profile')->with('success', 'Su contraseña se ha actualizado');


    } else{

        // Return a success response with the updated user data
        return redirect()->route('profile')->withErrors('Usuario no encontrado');

        }
    }

    public function delete(Request $request){

    }

}
