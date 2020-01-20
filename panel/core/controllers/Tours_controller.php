<?php

defined('_EXEC') or die;

class Tours_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Ajax 1: New or Edit
	** Ajax 2: Get
	** Ajax 3: Delete
	** Render: Page
	------------------------------------------------------------------------------- */
	public function index()
	{
		if (Format::exist_ajax_request() == true)
		{
			$action = $_POST['action'];
			$id = ($action == 'edit' OR $action == 'get' OR $action == 'delete' OR $action == 'add') ? $_POST['id'] : null;

			if ($action == 'new' OR $action == 'edit')
			{
				$name_es = !empty($_POST['name_es']) ? $_POST['name_es'] : null;
				$name_en = !empty($_POST['name_en']) ? $_POST['name_en'] : null;
				$description_es = !empty($_POST['description_es']) ? $_POST['description_es'] : null;
				$description_en = !empty($_POST['description_en']) ? $_POST['description_en'] : null;
				$cost_adults = !empty($_POST['cost_adults']) ? $_POST['cost_adults'] : null;
				$cost_children = !empty($_POST['cost_children']) ? $_POST['cost_children'] : null;
				$price_adults = !empty($_POST['price_adults']) ? $_POST['price_adults'] : null;
				$price_children = !empty($_POST['price_children']) ? $_POST['price_children'] : null;
				$discount_amount = !empty($_POST['discount_amount']) ? $_POST['discount_amount'] : null;
				$discount_type = !empty($_POST['discount_type']) ? $_POST['discount_type'] : null;
				$cover = !empty($_FILES['cover']['name']) ? $_FILES['cover'] : null;
                $availability = !empty($_POST['availability']) ? $_POST['availability'] : null;
                $destination = !empty($_POST['destination']) ? $_POST['destination'] : null;
                $provider = !empty($_POST['provider']) ? $_POST['provider'] : null;

				$errors = [];

				if (!isset($name_es))
					array_push($errors, ['name_es','No deje este campo vacío']);

				if (!isset($name_en))
					array_push($errors, ['name_en','No deje este campo vacío']);

				if (!isset($description_es))
					array_push($errors, ['description_es','No deje este campo vacío']);

				if (!isset($description_en))
					array_push($errors, ['description_en','No deje este campo vacío']);

				if (!isset($cost_adults))
					array_push($errors, ['cost_adults','No deje este campo vacío']);
                else if (!is_numeric($cost_adults))
					array_push($errors, ['cost_adults','Ingrese únicamente números']);
				else if ($cost_adults < 0)
					array_push($errors, ['cost_adults','No ingrese números negativos']);

				if (!isset($cost_children))
					array_push($errors, ['cost_children','No deje este campo vacío']);
                else if (!is_numeric($cost_children))
					array_push($errors, ['cost_children','Ingrese únicamente números']);
				else if ($cost_children < 0)
					array_push($errors, ['cost_children','No ingrese números negativos']);

				if (!isset($price_adults))
					array_push($errors, ['price_adults','No deje este campo vacío']);
                else if (!is_numeric($price_adults))
					array_push($errors, ['price_adults','Ingrese únicamente números']);
				else if ($price_adults < 0)
					array_push($errors, ['price_adults','No ingrese números negativos']);

				if (!isset($price_children))
					array_push($errors, ['price_children','No deje este campo vacío']);
                else if (!is_numeric($price_children))
					array_push($errors, ['price_children','Ingrese únicamente números']);
				else if ($price_children < 0)
					array_push($errors, ['price_children','No ingrese números negativos']);

				if (!isset($discount_amount) AND !empty($discount_type))
					array_push($errors, ['discount_amount','No deje este campo vacío']);
				if (!empty($discount_amount) AND !is_numeric($discount_amount))
					array_push($errors, ['discount_amount','Ingrese únicamente números']);
				else if (!empty($discount_amount) AND $discount_amount < 0)
					array_push($errors, ['discount_amount','No ingrese números negativos']);

				if (!isset($discount_type) AND !empty($discount_amount))
					array_push($errors, ['discount_type','No deje este campo vacío']);
				else if (!empty($discount_type) AND $discount_type != '$' AND $discount_type != '%')
					array_push($errors, ['discount_type','Dato inválido']);

				if (!isset($cover) AND $action == 'new')
					array_push($errors, ['cover','No deje este campo vacío']);

                if (!empty($availability) AND !is_numeric($availability))
					array_push($errors, ['availability','Ingrese únicamente números']);
				else if (!empty($availability) AND $availability < 0)
					array_push($errors, ['availability','No ingrese números negativos']);

                if (!isset($destination))
					array_push($errors, ['destination','No deje este campo vacío']);

                if (!isset($provider))
					array_push($errors, ['provider','No deje este campo vacío']);

				if (empty($errors))
				{
					$data = [
						'id_tour' => $id,
						'name' => [
							'es' => $name_es,
							'en' => $name_en,
						],
						'description' => [
							'es' => $description_es,
							'en' => $description_en,
						],
						'cost' => [
							'adults' => $cost_adults,
							'children' => $cost_children,
						],
						'price' => [
							'adults' => $price_adults,
							'children' => $price_children,
						],
						'discount' => [
							'amount' => $discount_amount,
							'type' => $discount_type,
						],
						'cover' => $cover,
						'availability' => $availability,
						'id_destination' => $destination,
						'id_provider' => $provider,
					];

					if ($action == 'new')
						$query = $this->model->new($data);
					else if ($action == 'edit')
						$query = $this->model->edit($data);

					if (!empty($query))
					{
						echo json_encode([
							'status' => 'success',
							'message' => 'Operación realizada correctamente'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'DATABASE OPERATION ERROR'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => $errors
					]);
				}
			}

			if ($action == 'get')
			{
				$query = $this->model->get($id);

				if (!empty($query))
				{
					echo json_encode([
						'status' => 'success',
						'data' => $query
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'DATABASE OPERATION ERROR'
					]);
				}
			}

			if ($action == 'delete')
			{
				$query = $this->model->delete($id);

				if (!empty($query))
				{
					echo json_encode([
						'status' => 'success',
						'message' => 'Operación realizada correctamente'
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'DATABASE OPERATION ERROR'
					]);
				}
			}
		}
		else
		{
			define('_title', '{$lang.title} | ' . Configuration::$web_page);

			$template = $this->view->render($this, 'index');

			$datas = $this->model->get('*', ['id_tour','name','price','discount','cover','destinations.name.destination','providers.name.provider']);
			$lst_datas = '';

			foreach ($datas as $value)
			{
				if (!empty($value['discount']))
				{
					if ($value['discount']['type'] == '$')
						$value['discount'] = 'Adultos: $ ' . ($value['price']['adults'] - $value['discount']['amount']) . ' USD ($ ' . $value['discount']['amount'] . ' USD) <br> Niños: $ ' . ($value['price']['children'] - $value['discount']['amount']) . ' USD ($ ' . $value['discount']['amount'] . ' USD)';
					else if ($value['discount']['type'] == '%')
						$value['discount'] = 'Adultos: $ ' . ($value['price']['adults'] - (($value['discount']['amount'] * $value['price']['adults']) / 100)) . ' USD (' . $value['discount']['amount'] . '%) <br> Niños: $ ' . ($value['price']['children'] - (($value['discount']['amount'] * $value['price']['children']) / 100)) . ' USD (' . $value['discount']['amount'] . '%)';
				}
				else
					$value['discount'] = 'Sin descuento';

				$lst_datas .=
				'<tr>
					<td><figure><img src="{$path.uploads}' . $value['cover'] . '"></figure></td>
					<td>' . $value['name']['en'] . ' / ' . $value['name']['es'] . '</td>
					<td>Adultos: $ ' . $value['price']['adults'] . ' USD <br> Niños: $ ' . $value['price']['children'] . ' USD</td>
					<td>' . $value['discount'] . '</td>
					<td>' . $value['destination'] . '</td>
					<td>' . $value['provider'] . '</td>
					<td>
						<a data-action="delete" data-id="' . $value['id_tour'] . '"><i class="material-icons">delete</i><span>Eliminar</span></a>
						<!--<a data-action="get" data-id="' . $value['id_tour'] . '" data-option="gallery"><i class="material-icons">photo</i><span>Galería</span></a>-->
						<a data-action="get" data-id="' . $value['id_tour'] . '" data-option="datas"><i class="material-icons">menu</i><span>Detalles | Editar</span></a>
					</td>
				</tr>';
			}

			$destinations = $this->model->get('*', '*', 'destinations');
			$lst_destinations = '';

			foreach ($destinations as $value)
				$lst_destinations .= '<option value="' . $value['id_destination'] . '">' . $value['name'] . '</option>';

			$providers = $this->model->get('*', '*', 'providers');
			$lst_providers = '';

			foreach ($providers as $value)
				$lst_providers .= '<option value="' . $value['id_provider'] . '">' . $value['name'] . '</option>';

			$replace = [
				'{$lst_datas}' => $lst_datas,
				'{$lst_providers}' => $lst_providers,
				'{$lst_destinations}' => $lst_destinations,
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
