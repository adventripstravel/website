<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.models
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

class Users_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get($id = '*', $fields = '*', $table = 'users')
	{
		if ($table == 'users')
		{
			if ($id == '*')
			{
				$condition = [
					'ORDER' => [
						'users.id_user_level' => 'ASC',
						'users.name' => 'ASC'
					]
				];
			}
			else
			{
				$condition = [
					'users.id_user' => $id
				];
			}

			if ($fields == '*')
			{
				$fields = [
					'users.id_user',
					'users.token',
					'users.name',
					'users.email',
					'users.phone',
					'users.username',
					'users.password',
					'users.id_user_level',
					'users.avatar',
					'users.profile',
					'users.register_date',
					'users.status',
				];
			}
			else
			{
				foreach ($fields as $key => $value)
				{
					$explode = explode('.', $value);

					if (count($explode) == 3)
						$fields[$key] = $explode[0] . '.' . $explode[1] . ' (' . $explode[2] . ')';
					else
						$fields[$key] = 'users.' . $value;
				}
			}

			$query = $this->database->select('users', [
				'[>]users_levels' => [
					'id_user_level' => 'id_user_level'
				]
			], $fields, $condition);
		}
		else if ($table == 'users_levels')
		{
			if ($id == '*')
			{
				$condition = [
					'ORDER' => [
						'id_user_level' => 'ASC'
					]
				];
			}
			else
			{
				$condition = [
					'id_user_level' => $id
				];
			}

			$query = $this->database->select('users_levels', $fields, $condition);
		}

		if ($id == '*')
			return Functions::get_decoded_query($query);
		else
			return !empty($query) ? Functions::get_decoded_query($query[0]) : null;
	}

	/* Inserts
	------------------------------------------------------------------------------- */
	public function new($data)
	{
		$query = null;

		$go = true;

		if (!empty($data['avatar']))
		{
			$data['avatar'] = Functions::uploader($data['avatar'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited');
			$go = !empty($data['avatar']) ? true : false;
		}

		if ($go == true)
		{
			$query = $this->database->insert('users', [
				'token' => Functions::get_random(6),
				'name' => $data['name'],
				'email' => $data['email'],
				'phone' => $data['phone'],
				'username' => $data['username'],
				'password' => Functions::get_encrypted($data['password']),
				'id_user_level' => $data['id_user_level'],
				'avatar' => $data['avatar'],
				'profile' => 'airbnb',
				'register_date' => Functions::get_date(),
				'status' => true,
			]);

			if (!empty($query))
				$query = $this->database->id($query);
		}

		return $query;
	}

	/* Updates
	------------------------------------------------------------------------------- */
	public function edit($data)
	{
		$query = null;

		if ($data['action'] == 'restore_password')
		{
			$query = $this->database->update('users', [
				'password' => $data['password'],
			], [
				'id_user' => $data['id']
			]);
		}
		else
		{
			$edited = $this->get($data['id_user'], ['avatar']);

			if (!empty($edited))
			{
				$go = true;

				if (!empty($data['avatar']))
				{
					$data['avatar'] = Functions::uploader($data['avatar'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited');
					$go = !empty($data['avatar']) ? true : false;
				}
				else
					$data['avatar'] = $edited['avatar'];

				if ($go == true)
				{
					$query = $this->database->update('users', [
						'name' => $data['name'],
						'email' => $data['email'],
						'phone' => $data['phone'],
						'username' => $data['username'],
						'id_user_level' => $data['id_user_level'],
						'avatar' => $data['avatar'],
						'profile' => 'airbnb',
						'status' => true,
					], [
						'id_user' => $data['id']
					]);

					if (!empty($query) AND $data['avatar'] != $edited['avatar'])
						Functions::undoloader($edited['avatar'], PATH_UPLOADS);
				}
			}
		}

		return $query;
	}

	/* Deletes
	------------------------------------------------------------------------------- */
	public function delete($id)
	{
		$query = null;

		$deleted = $this->get($id, ['avatar']);

		if (!empty($deleted))
		{
			$query = $this->database->delete('users', [
				'id_user' => $id
			]);

			if (!empty($query))
				Functions::undoloader($deleted['avatar'], PATH_UPLOADS);
		}

		return $query;
	}

	/* Others
	------------------------------------------------------------------------------- */
}
