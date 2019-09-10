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
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

class Index_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_user($username)
	{
		$query = $this->database->select('users', [
			'[>]users_levels' => [
				'id_user_level' => 'id_user_level'
			]
		], [
			'users.id_user',
			'users.name',
			'users.email',
			'users.username',
			'users.password',
			'users_levels.code(level)',
			'users.avatar',
		], [
			'AND' => [
				'users.username' => $username,
				'users.status' => true
			]
		]);

		return !empty($query) ? $query[0] : null;
	}
}
