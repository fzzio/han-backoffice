<?php namespace App\Controllers;

use App\Libraries\GroceryCrud;

class Backend extends BaseController
{
	public function __construct() {
		date_default_timezone_set("America/Guayaquil");
		helper(
            array(
                'url',
                'form',
            )
        );
	}

	public function index() {
		$title = "Huele a Nuevo";
		$data = [
			'page_title' => $title,
		];
		return view('backend/blank', $data);
	}

	public function client() {
		$title = "Clientes";
	    $crud = new GroceryCrud();

	    $crud->setTable( 'client' );
		$crud->displayAs( 'dni' , 'Cédula' );
		$crud->displayAs( 'name' , 'Nombres' );
		$crud->displayAs( 'lastname' , 'Apellidos' );
		$crud->displayAs( 'cellphone' , 'Celular (593XXXXXXXXX)' );
		$crud->displayAs( 'address' , 'Dirección' );
		$crud->displayAs( 'phone' , 'Teléfono convencional' );
		$crud->displayAs( 'email' , 'Correo' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->fields(['dni', 'name', 'lastname', 'cellphone', 'phone', 'address', 'email', 'status', 'created']);
		$crud->columns(['dni', 'name', 'lastname', 'cellphone', 'phone', 'address', 'status', 'created']);
		$crud->requiredFields(['dni', 'name', 'lastname', 'cellphone', 'address', 'email', 'status']);

		$crud->fieldType('dni', 'integer');
		$crud->fieldType('cellphone', 'integer');
		$crud->fieldType('phone', 'integer');

		$crud->fieldType('modified','hidden');
		$crud->fieldType('status', 'dropdown', array(
			STATUS_INACTIVE => 'Inactive',
			STATUS_ACTIVE => 'Active',
		));

		$crud->unsetExport();

		$output = $crud->render();

		$data = [
			'page_title' => $title,
			'css_files' => $output->css_files,
			'output' => $output->output,
			'js_files' => $output->js_files,
		];

		return view('backend/blank', $data);
	}
	
	public function plan() {
		$title = "Planes";
	    $crud = new GroceryCrud();

	    $crud->setTable( 'plan' );
		$crud->displayAs( 'name' , 'Nombre' );
		$crud->displayAs( 'pounds' , 'Libras' );
		$crud->displayAs( 'price' , 'Precio' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->fields(['name', 'pounds', 'price', 'status', 'created']);
		$crud->columns(['name', 'pounds', 'price', 'status', 'created']);
		$crud->requiredFields(['name', 'pounds', 'price', 'status']);

		$crud->fieldType('pounds', 'integer');
		$crud->fieldType('price', 'integer');	

		$crud->fieldType('modified','hidden');
		$crud->fieldType('status', 'dropdown', array(
			STATUS_INACTIVE => 'Inactive',
			STATUS_ACTIVE => 'Active',
		));

		$crud->unsetExport();

		$output = $crud->render();

		$data = [
			'page_title' => $title,
			'css_files' => $output->css_files,
			'output' => $output->output,
			'js_files' => $output->js_files,
		];

		return view('backend/blank', $data);
	}

	public function planAssignation() {
		$title = "Cliente Plan";
		$crud = new GroceryCrud();
		
		$crud->setTable( 'client_plan' );
		$crud->displayAs( 'client_id' , 'Cliente' );
		$crud->displayAs( 'plan_id' , 'Plan' );
		$crud->displayAs( 'created' , 'Creado' );
		$crud->displayAs( 'start_date' , 'Fecha Inicio' );
		$crud->displayAs( 'end_date' , 'Fecha Fin' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->setRelation('client_id','client','{lastname} {name}');
		$crud->setRelation('plan_id','plan','{name} - {pounds} lbs.');

		$crud->unsetExport();

		$output = $crud->render();

		$data = [
			'page_title' => $title,
			'css_files' => $output->css_files,
			'output' => $output->output,
			'js_files' => $output->js_files,
		];

		return view('backend/blank', $data);
	}

	public function employee(){
		$title = "Empleado";
	    $crud = new GroceryCrud();

	    $crud->setTable( 'employee' );
		$crud->displayAs( 'dni' , 'Cédula' );
		$crud->displayAs( 'name' , 'Nombres' );
		$crud->displayAs( 'lastname' , 'Apellidos' );
		$crud->displayAs( 'cellphone' , 'Celular (593XXXXXXXXX)' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->fields(['dni', 'name', 'lastname', 'cellphone', 'status', 'created']);
		$crud->columns(['dni', 'name', 'lastname', 'cellphone', 'status', 'created']);
		$crud->requiredFields(['dni', 'name', 'lastname', 'cellphone', 'status']);

		$crud->fieldType('dni', 'integer');
		$crud->fieldType('cellphone', 'integer');
		$crud->fieldType('phone', 'integer');

		$crud->fieldType('modified','hidden');
		$crud->fieldType('status', 'dropdown', array(
			STATUS_INACTIVE => 'Inactive',
			STATUS_ACTIVE => 'Active',
		));

		$crud->unsetExport();

		$output = $crud->render();

		$data = [
			'page_title' => $title,
			'css_files' => $output->css_files,
			'output' => $output->output,
			'js_files' => $output->js_files,
		];

		return view('backend/blank', $data);
	}

	public function order() {
		$title = "Pedido";
		$crud = new GroceryCrud();
		
		$crud->setTable( 'order' );
		$crud->displayAs( 'client_id' , 'Cliente' );
		$crud->displayAs( 'created' , 'Creación' );
		$crud->displayAs( 'modified' , 'Modificación' );
		$crud->displayAs( 'delivered' , 'Entrega' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->setRelation('client_id','client','{lastname} {name}');

		$crud->unsetExport();

		$output = $crud->render();

		$data = [
			'page_title' => $title,
			'css_files' => $output->css_files,
			'output' => $output->output,
			'js_files' => $output->js_files,
		];

		return view('backend/blank', $data);
	}

	public function orderDetail() {
		$title = "Pedido Detalle";
		$crud = new GroceryCrud();
		
		$crud->setTable( 'order_detail' );
		$crud->displayAs( 'client_id' , 'Cliente' );
		$crud->displayAs( 'created' , 'Creación' );
		$crud->displayAs( 'modified' , 'Modificación' );
		$crud->displayAs( 'delivered' , 'Entrega' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->setRelation('client_id','client','{lastname} {name}');

		$crud->unsetExport();

		$output = $crud->render();

		$data = [
			'page_title' => $title,
			'css_files' => $output->css_files,
			'output' => $output->output,
			'js_files' => $output->js_files,
		];

		return view('backend/blank', $data);
	}
}
