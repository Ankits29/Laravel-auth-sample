<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class Customer
 * 
 * @property int $cust_id
 * @property string|null $cust_fname
 * @property string|null $cust_email
 * @property string|null $password
 * @property string|null $cust_phone
 * @property string|null $cust_DOB
 * @property string|null $cust_address
 * @property int $cust_status
 * @property Carbon $cust_createdate
 * @property Carbon $cust_updatedate
 *
 * @package App\Models
 */
class Customer extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	protected $table = 'customers';
	protected $primaryKey = 'cust_id';
	public $timestamps = false;

	protected $casts = [
		'cust_status' => 'int',
		'cust_createdate' => 'datetime',
		'cust_updatedate' => 'datetime'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'cust_fname',
		'cust_email',
		'password',
		'cust_phone',
		'cust_DOB',
		'cust_address',
		'cust_createdate',
		'cust_updatedate'
	];
}
