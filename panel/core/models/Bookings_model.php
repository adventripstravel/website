<?php

defined('_EXEC') or die;

class Bookings_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get($id = '*', $fields = '*', $time = 'today')
	{
		if ($id == '*')
	    {
	       if ($time == 'today')
		   {
			   $condition = [
				   'bookings.date_booking[>=]' => Functions::get_date(),
				   'ORDER' => [
					   'bookings.date_booking' => 'ASC'
				   ]
			   ];
		   }
	       else if ($time == 'past')
		   {
			   $condition = [
				   'bookings.date_booking[<]' => Functions::get_date(),
				   'ORDER' => [
					   'bookings.date_booking' => 'ASC'
				   ]
			   ];
		   }
	    }
	    else
	    {
	        $condition = [
	            'bookings.id_booking' => $id
	        ];
	    }

	    if ($fields == '*')
	    {
	        $fields = [
	            'bookings.id_booking',
	            'bookings.token',
	            'bookings.name',
	            'bookings.email',
	            'bookings.cellphone',
	            'bookings.id_tour',
	            'tours.name(tour)',
	            'bookings.date_booking',
	            'bookings.observations',
	            'bookings.paxes',
	            'bookings.totals',
	            'bookings.payment',
	            'bookings.language',
	            'bookings.canceled',
	            'bookings.date_booked',
	            'bookings.id_airbnb',
	            'airbnbs.name(airbnb)',
	            'users.name(user)',
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
	                $fields[$key] = 'bookings.' . $value;
	        }
	    }

	    $query = $this->database->select('bookings', [
	        '[>]tours' => [
	            'id_tour' => 'id_tour'
	        ],
	        '[>]airbnbs' => [
	            'id_airbnb' => 'id_airbnb'
	        ],
	        '[>]users' => [
	            'airbnbs.id_user' => 'id_user'
	        ],
	    ], $fields, $condition);

	    if ($id == '*')
	        return Functions::get_decoded_query($query);
	    else
	        return !empty($query) ? Functions::get_decoded_query($query[0]) : null;
	}

	/* Inserts
	------------------------------------------------------------------------------- */

	/* Updates
	------------------------------------------------------------------------------- */
	public function edit($data)
	{
		$query = $this->database->update('bookings', [
			'name' => $data['name'],
			'email' => $data['email'],
			'cellphone' => $data['cellphone'],
			'observations' => $data['observations'],
			'language' => $data['language'],
			'canceled' => $data['canceled'],
		], [
			'id_booking' => $data['id_booking']
		]);

		return $query;
	}

	/* Deletes
	------------------------------------------------------------------------------- */

	/* Others
	------------------------------------------------------------------------------- */
}
