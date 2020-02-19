<?php
defined('_EXEC') or die;

class Calendar_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function script()
	{
		Format::set_time_zone();
		header('Content-Type: application/javascript');

		$events = [];

		foreach ( $this->model->get_reservations() as $value )
		{
			switch ( $value['origin'] )
			{
				case 'direct':
				default:
					$color = "#508aeb";
					break;

				case 'partners':
					$color = "#b71c1c";
					break;

				case 'el_cid':
					$color = "#ffeb3b";
					break;

				case 'voyager':
					$color = "#ff9800";
					break;

				case 'courtesy':
					$color = "#f44336";
					break;

				case 'other':
					$color = "#607d8b";
					break;
			}

			$duration = ($value['data']['reservation']['hours_extra']['hours_extra'] > 0) ? $value['data']['yacht']['duration'] + $value['data']['reservation']['hours_extra']['hours_extra'] : $value['data']['yacht']['duration'];
			$title = explode(',', $value['data']['yacht']['name'])[0] .', Folio: '. $value['folio'] .', '. $value['data']['customer']['name'] .', '. $duration .' Hrs.';
			$start_time = $this->model->datetime($value['data']['reservation']['date'] .' '. str_replace(' Hrs', '', $value['data']['reservation']['hour']));
			$end_time = $this->model->datetime(date('Y-m-d H:i', strtotime("+{$duration} hours", strtotime($start_time))));

			$events[] = [
				'title' => $title,
				'start' => $start_time,
				'end' => $end_time,
				'color' => $color,
				'url' => 'index.php?c=Reservations&m=view&p='. $value['folio']
			];
		}

		$events = json_encode($events);

		$js =
			"document.addEventListener('DOMContentLoaded', function()
			{
				var calendarEl = document.getElementById('calendar');

				var calendar = new FullCalendar.Calendar(calendarEl, {
					aspectRatio: 0.8,
					locale: 'es',
					editable: false,
					eventLimit: true,
					nowIndicator: true,
					navLinks: true,
					displayEventTime: true,
					displayEventEnd: true,
					now: ". json_encode($this->model->datetime()) .",
					plugins: [ 'dayGrid', 'timeGrid', 'list' ],
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'dayGridMonth,timeGridWeek,timeGridDay, listMonth'
					},
					events: {$events},
					eventClick: function ( event )
					{
						if ( event.url )
						{
							window.open(event.url, '_blank');
							return false;
						}
					},
					eventTimeFormat: {
						hour: '2-digit',
						minute: '2-digit',
						hour12: true
					}
				});

				calendar.render();
			});";

		echo $js;
	}

	public function index()
	{
		$template = $this->view->render($this, 'calendar');

		echo $template;
	}
}
