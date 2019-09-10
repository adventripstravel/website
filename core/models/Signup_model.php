<?php

defined('_EXEC') or die;

/**
* @package valkyrie.core.models
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since December 01 - 15, 2018 <@update>
* @version 1.1.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

class Signup_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */

	/* Inserts
	------------------------------------------------------------------------------- */
	public function new_user($data)
	{
		$query = $this->database->insert('users', [
			'token' => $data['token'],
			'name' => $data['name'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'username' => $data['username'],
			'password' => $data['password'],
			'id_user_level' => $data['id_user_level'],
			'avatar' => $data['avatar'],
			'profile' => $data['profile'],
			'register_date' => $data['register_date'],
			'status' => $data['status'],
		]);

		if (!empty($query))
			$query = $this->database->id($query);

		return $query;
	}

	/* Updates
	------------------------------------------------------------------------------- */

	/* Deletes
	------------------------------------------------------------------------------- */

	/* Others
	------------------------------------------------------------------------------- */
}
