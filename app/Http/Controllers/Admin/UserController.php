<?php namespace App\Http\Controllers\Admin;

use App\User;

class UserController{

	public function save(UserRequest $request) {
        $user = new User ();
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> password = bcrypt($request->password);
        $user -> save();
    }


}