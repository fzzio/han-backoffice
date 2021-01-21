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

	public function index()
	{
		echo "Hello HAN";
	}

	public function client() {
		$title = "Clientes";
	    $crud = new GroceryCrud();

	    $crud->setTable( 'client' );
		$crud->displayAs( 'dni' , 'Cédula' );
		$crud->displayAs( 'name' , 'Nombres' );
		$crud->displayAs( 'lastname' , 'Apellidos' );
		$crud->displayAs( 'cellphone' , 'Celular' );
		$crud->displayAs( 'address' , 'Dirección' );
		$crud->displayAs( 'phone' , 'Teléfono convencional' );
		$crud->displayAs( 'email' , 'Correo' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->fields(['dni', 'name', 'lastname', 'cellphone', 'phone', 'address', 'email', 'status', 'created', 'modified']);
		$crud->columns(['dni', 'name', 'lastname', 'cellphone', 'phone', 'address', 'status']);
		$crud->requiredFields(['dni', 'name', 'lastname', 'cellphone', 'address', 'email', 'status']);

		$crud->fieldType('dni', 'integer');
		$crud->fieldType('status', 'dropdown', array(
			STATUS_INACTIVE => 'Inactive',
			STATUS_ACTIVE => 'Active',
		));

		$crud->unsetExport();

		$output = $crud->render();

		$data = array(
			'page_title' => $title,
			'css_files' => $output->css_files,
			'output' => $output->output,
			'js_files' => $output->js_files,
		);

		return view('backend/blank', $data);
	}
}
