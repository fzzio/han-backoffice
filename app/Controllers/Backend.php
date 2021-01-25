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

	public function admin() {
		$title = "Huele a Nuevo :: Admin";
		$data = [
			'page_title' => $title,
		];
		return view('backend/admin', $data);
	}

	public function superadmin() {
		$title = "Huele a Nuevo :: Super Admin";
		$data = [
			'page_title' => $title,
		];
		return view('backend/super-admin', $data);
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
			STATUS_ACTIVE => ucwords(lang('Hueleanuevo.active')),
			STATUS_INACTIVE => ucwords(lang('Hueleanuevo.inactive')),
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
		$crud->displayAs( 'price' , 'Precio $' );
		$crud->displayAs( 'status' , 'Estado' );
		
		$crud->columns(['name', 'pounds', 'price', 'status', 'created']);
		$crud->fields(['name', 'pounds', 'price', 'status', 'created']);
		$crud->requiredFields(['name', 'pounds', 'price', 'status']);

		$crud->fieldType('pounds', 'integer');
		$crud->fieldType('price', 'integer');	

		$crud->fieldType('modified','hidden');
		$crud->fieldType('status', 'dropdown', array(
			STATUS_ACTIVE => ucwords(lang('Hueleanuevo.active')),
			STATUS_INACTIVE => ucwords(lang('Hueleanuevo.inactive')),
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

	public function product() {
		$title = "Producto";
	    $crud = new GroceryCrud();

		$crud->setTable( 'product' );
		
		$crud->displayAs( 'name' , 'Nombre' );
		$crud->displayAs( 'price' , 'Precio $' );
		
		$crud->columns(['name', 'price', 'status']);
		$crud->fields(['name', 'price', 'created', 'status']);
		$crud->requiredFields(['name', 'created', 'status']);
		
		$crud->fieldType('price', 'integer');
		$crud->fieldType('status', 'dropdown', array(
			STATUS_ACTIVE => ucwords(lang('Hueleanuevo.active')),
			STATUS_INACTIVE => ucwords(lang('Hueleanuevo.inactive')),
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

		$crud->setRelation('client_id','client','[{dni}] - {lastname} {name}');
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

	public function role(){
		$title = "Rol";
	    $crud = new GroceryCrud();

	    $crud->setTable( 'role' );
		$crud->displayAs( 'name' , 'Nombre del Rol' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->fields(['name', 'status', 'created']);
		$crud->columns(['name', 'status', 'created']);
		$crud->requiredFields(['name', 'status']);

		$crud->fieldType('modified','hidden');
		$crud->fieldType('status', 'dropdown', array(
			STATUS_ACTIVE => ucwords(lang('Hueleanuevo.active')),
			STATUS_INACTIVE => ucwords(lang('Hueleanuevo.inactive')),
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

	public function employee(){
		$title = "Empleado";
	    $crud = new GroceryCrud();

	    $crud->setTable( 'employee' );
		$crud->displayAs( 'dni' , 'Cédula' );
		$crud->displayAs( 'name' , 'Nombres' );
		$crud->displayAs( 'lastname' , 'Apellidos' );
		$crud->displayAs( 'role_id' , 'Rol' );
		$crud->displayAs( 'cellphone' , 'Celular (593XXXXXXXXX)' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->columns(['role_id', 'dni', 'name', 'lastname', 'cellphone', 'status', 'created']);
		$crud->fields(['dni', 'name', 'lastname', 'role_id', 'cellphone', 'status', 'created']);
		$crud->requiredFields(['role_id', 'dni', 'name', 'lastname', 'cellphone', 'status']);

		$crud->fieldType('dni', 'integer');
		$crud->fieldType('cellphone', 'integer');
		$crud->fieldType('phone', 'integer');

		$crud->setRelation('role_id','role','name');

		$crud->fieldType('modified','hidden');
		$crud->fieldType('status', 'dropdown', array(
			STATUS_ACTIVE => ucwords(lang('Hueleanuevo.active')),
			STATUS_INACTIVE => ucwords(lang('Hueleanuevo.inactive')),
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
		$crud->displayAs( 'employee_id' , 'Empleado' );
		$crud->displayAs( 'client_id' , 'Cliente' );
		$crud->displayAs( 'created' , 'Fecha de Recibido' );
		$crud->displayAs( 'modified' , 'Modificación' );
		$crud->displayAs( 'delivered' , 'Fecha de Entrega' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->setRelation('employee_id', 'employee', '{lastname} {name}');
		$crud->setRelation('client_id', 'client', '{lastname} {name}');

		$crud->columns(['client_id', 'status', 'employee_id', 'created', 'delivered']);
		$crud->fields(['employee_id', 'client_id', 'status', 'created', 'delivered']);
		$crud->requiredFields(['employee_id', 'client_id', 'status', 'created', 'delivered']);

		$crud->fieldType('status', 'dropdown', array(
			ORDER_STATUS_RECEIVED => 'Received',
			ORDER_STATUS_PROCESSED => 'Processed',
			ORDER_STATUS_DELIVERED => 'Delivered',
			ORDER_STATUS_CANCELED => 'Canceled',
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

	public function orderDetail() {
		$title = "Detalle del pedido";
		$crud = new GroceryCrud();
		
		$crud->setTable( 'order_detail' );

		$crud->displayAs( 'order_id' , 'No. Orden' );
		$crud->displayAs( 'amount' , 'Libras' );
		$crud->displayAs( 'price' , 'Precio $' );
		$crud->displayAs( 'created' , 'Creado' );
		$crud->displayAs( 'modified' , 'Modificado' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->columns(['order_id', 'amount', 'price', 'created', 'status']);
		$crud->fields(['order_id', 'amount', 'created', 'modified', 'status']);
		$crud->requiredFields(['order_id', 'amount', 'created', 'status']);

		$crud->fieldType('amount', 'integer');
		$crud->fieldType('status', 'dropdown', array(
			STATUS_ACTIVE => ucwords(lang('Hueleanuevo.active')),
			STATUS_INACTIVE => ucwords(lang('Hueleanuevo.inactive')),
		));

		$crud->setRelation('order_id', 'order','{order_id}');

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
