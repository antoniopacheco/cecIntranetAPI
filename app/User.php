<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Http\Models\Privilegios_aplicaciones;
/**
 * @SWG\Model(id="User")
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users2';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	/**
 * @SWG\Property(
 *      name="name",
 *		type="string",
 *      description="Nombre del Usuario"),
 *		required=true
 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	public function privilegios_aplicaciones(){
		return $this->hasMany('App\Models\Privilegios_aplicaciones','users_id')->with('aplicacion');
	}

}
