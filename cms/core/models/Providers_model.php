<?php

defined('_EXEC') or die;

class Providers_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get($id = '*', $fields = '*')
	{
		if ($id == '*')
		{
			$condition = [
				'ORDER' => [
					'name' => 'ASC'
				]
			];
		}
		else
		{
			$condition = [
				'id_provider' => $id
			];
		}

		$query = $this->database->select('providers', $fields, $condition);

		if ($id == '*')
			return Functions::get_decoded_query($query);
		else
			return !empty($query) ? Functions::get_decoded_query($query[0]) : null;
	}

	/* Inserts
	------------------------------------------------------------------------------- */
	public function new($data)
	{
		$query = $this->database->insert('providers', [
			'name' => $data['name'],
		]);

		if (!empty($query))
			$query = $this->database->id($query);

		return $query;
	}

	/* Updates
	------------------------------------------------------------------------------- */
	public function edit($data)
	{
		$query = $this->database->update('providers', [
			'name' => $data['name'],
		], [
			'id_provider' => $data['id_provider']
		]);

		return $query;
	}

	/* Deletes
	------------------------------------------------------------------------------- */
	public function delete($id)
	{
		$query = $this->database->delete('providers', [
			'id_provider' => $id
		]);

		return $query;
	}

	/* Others
	------------------------------------------------------------------------------- */
}
