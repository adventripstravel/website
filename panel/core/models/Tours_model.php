<?php

defined('_EXEC') or die;

class Tours_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get($id = '*', $fields = '*', $table = 'tours')
	{
		if ($table == 'tours')
	    {
			if ($id == '*')
		    {
		        $condition = [
		            'ORDER' => [
		                'tours.id_provider' => 'ASC',
		                'tours.id_destination' => 'ASC',
		                'tours.name' => 'ASC',
		            ]
		        ];
		    }
		    else
		    {
		        $condition = [
		            'tours.id_tour' => $id
		        ];
		    }

		    if ($fields == '*')
		    {
		        $fields = [
		            'tours.name',
		            'tours.description',
		            'tours.cost',
		            'tours.price',
					'tours.discount',
		            'tours.cover',
		            'tours.gallery',
		            'tours.availability',
		            'tours.id_destination',
		            'destinations.name(destination)',
		            'tours.id_provider',
		            'providers.name(provider)',
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
		                $fields[$key] = 'tours.' . $value;
		        }
		    }

		    $query = $this->database->select('tours', [
		        '[>]destinations' => [
		            'id_destination' => 'id_destination'
		        ],
		        '[>]providers' => [
		            'id_provider' => 'id_provider'
		        ],
		    ], $fields, $condition);
	    }
	    else if ($table == 'destinations')
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
	    }
	    else if ($table == 'providers')
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

		$data['cover'] = Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited');

		if (!empty($data['cover']))
		{
			$query = $this->database->insert('tours', [
				'name' => json_encode($data['name']),
				'description' => json_encode($data['description']),
				'cost' => json_encode($data['cost']),
				'price' => json_encode($data['price']),
				'discount' => (!empty($data['discount']['amount']) ? json_encode($data['discount']) : null),
				'cover' => $data['cover'],
				'availability' => $data['availability'],
				'id_destination' => $data['id_destination'],
				'id_provider' => $data['id_provider'],
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

		$edited = $this->get($data['id_tour'], ['cover']);

		if (!empty($edited))
		{
			$data['cover'] = !empty($data['cover']) ? Functions::uploader($data['cover'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited') : $edited['cover'];

			if (!empty($data['cover']))
			{
				$query = $this->database->update('tours', [
					'name' => json_encode($data['name']),
					'description' => json_encode($data['description']),
					'cost' => json_encode($data['cost']),
					'price' => json_encode($data['price']),
					'discount' => (!empty($data['discount']['amount']) ? json_encode($data['discount']) : null),
					'cover' => $data['cover'],
					'availability' => $data['availability'],
					'id_destination' => $data['id_destination'],
					'id_provider' => $data['id_provider'],
				], [
					'id_tour' => $data['id_tour']
				]);

				if (!empty($query) AND $data['cover'] != $edited['cover'])
					Functions::undoloader($edited['cover'], PATH_UPLOADS);
			}

			// $data['gallery'] = Functions::uploader($data['gallery'], PATH_UPLOADS, ['png','jpg','jpeg'], 'unlimited');
			// $data['gallery'] = (!empty($edited['gallery'])) ? array_merge($edited['gallery'], $data['gallery']) : $data['gallery'];
			//
			// $query = $this->database->update('tours', [
			// 	'gallery' => json_encode($data['gallery'])
			// ], [
			// 	'id_tour' => $data['id_tour']
			// ]);
			//
			// if (!empty($query))
			// 	$query = $data['gallery'];
		}

		return $query;
	}

	/* Deletes
	------------------------------------------------------------------------------- */
	public function delete($id)
	{
		$query = null;

		$deleted = $this->get($id, ['cover','gallery']);

		if (!empty($deleted))
		{
			$query = $this->database->delete('tours', [
				'id_tour' => $id
			]);

			if (!empty($query))
			{
				Functions::undoloader($deleted['cover'], PATH_UPLOADS);
				Functions::undoloader($deleted['gallery'], PATH_UPLOADS);
			}

			// $key = $deleted['gallery'][$key];
			//
			// unset($key);
			//
			// $deleted['gallery'] = array_merge($deleted['gallery']);
			//
			// $query = $this->database->update('tours', [
			// 	'gallery' => json_encode($deleted['gallery'])
			// ], [
			// 	'id_tour' => $id
			// ]);
			//
			// if (!empty($query))
			// {
			// 	Functions::undoloader($key, PATH_UPLOADS);
			// 	$query = $deleted['gallery'];
			// }
		}

		return $query;
	}

	/* Others
	------------------------------------------------------------------------------- */
}
