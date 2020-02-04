<?php

defined('_EXEC') or die;

class Index_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_login($email)
	{
		$query = Functions::get_array_json_decoded($this->database->select('users', [
			'id',
			'firstname',
			'lastname',
			'email',
			'password',
			'user_permissions',
			'avatar',
			'status'
		], [
			'email' => $email
		]));

		if (!empty($query))
		{
			foreach ($query[0]['user_permissions'] as $key => $value)
			{
				$value = $this->database->select('user_permissions', [
					'code'
				], [
					'id' => $value
				]);

				if (!empty($value))
					$query[0]['user_permissions'][$key] = $value[0]['code'];
				else
					unset($query[0]['user_permissions'][$key]);
			}

			return $query[0];
		}
		else
			return null;
	}
}
