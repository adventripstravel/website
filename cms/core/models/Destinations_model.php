<?php

defined('_EXEC') or die;

class Destinations_model extends Model
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
				'id_destination' => $id
			];
		}

		$query = $this->database->select('destinations', $fields, $condition);

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

		$data['cover'] = Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited');

		if (!empty($data['cover']))
		{
			$query = $this->database->insert('destinations', [
				'name' => $data['name'],
				'cover' => $data['cover']
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

		$edited = $this->get($data['id_destination'], ['cover']);

		if (!empty($edited))
		{
			$data['cover'] = !empty($data['cover']) ? Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited') : $edited['cover'];

			if (!empty($data['cover']))
			{
				$query = $this->database->update('destinations', [
					'name' => $data['name'],
					'cover' => $data['cover']
				], [
					'id_destination' => $data['id_destination']
				]);

				if (!empty($query) AND $data['cover'] != $edited['cover'])
					Functions::undoloader($edited['cover'], PATH_UPLOADS);
			}
		}

		return $query;
	}

	/* Deletes
	------------------------------------------------------------------------------- */
	public function delete($id)
	{
		$query = null;

		$deleted = $this->get($id, ['cover']);

		if (!empty($deleted))
		{
			$query = $this->database->delete('destinations', [
				'id_destination' => $id
			]);

			if (!empty($query))
				Functions::undoloader($deleted['cover'], PATH_UPLOADS);
		}

		return $query;
	}

	/* Others
	------------------------------------------------------------------------------- */
}
