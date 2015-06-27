<?php namespace YourAppNamespace;

use Auth;

class Verifier
{
  public function verify($username, $password)
  {
      $credentials = [
                  'email'    => $username,
                  'password' => $password,
      ];

      if (Auth::once($credentials)) {
          return Auth::user()->id;
      }

      return false;
  }
}
