<?php namespace App\Controllers;

use App\Libraries\GroceryCrud;
use CodeIgniter\I18n\Time;

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

		$crud->setRule('email', 'Email', 'valid_email');

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
		$crud->displayAs( 'price_plan' , 'Precio Plan' );
		$crud->displayAs( 'price_pound' , 'Precio Libra' );
		$crud->displayAs( 'status' , 'Estado' );
		
		$crud->columns(['name', 'pounds', 'price_plan', 'price_pound', 'status', 'created']);
		$crud->fields(['name', 'pounds', 'price_plan', 'price_pound', 'status', 'created']);
		$crud->requiredFields(['name', 'pounds', 'price_plan', 'price_pound', 'status']);

		$crud->fieldType('pounds', 'integer');
		$crud->fieldType('price_plan', 'integer');	
		$crud->fieldType('price_pound', 'integer');	

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
		$crud->displayAs( 'contract_months' , 'Meses contratados' );
		$crud->displayAs( 'cycle_start' , 'Ciclo inicio' );
		$crud->displayAs( 'cycle_end' , 'Ciclo Fin' );
		$crud->displayAs( 'available' , 'Libras disponibles' );
		$crud->displayAs( 'consumed' , 'Libras consumidas' );
		$crud->displayAs( 'created' , 'Fecha de contrato' );
		$crud->displayAs( 'modified' , 'Modificado' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->setRelation('plan_id','plan','{name} - {pounds} lbs.', ['status' => STATUS_ACTIVE]);
		$crud->setRelation('client_id','client','[{dni}] - {lastname} {name}', ['status' => STATUS_ACTIVE]);

		$crud->columns(['plan_id', 'client_id', 'available', 'consumed', 'cycle_start', 'cycle_end', 'contract_months', 'created', 'status']);
		$crud->fields(['plan_id', 'client_id', 'status', 'available', 'consumed', 'cycle_start', 'cycle_end', 'contract_months', 'created']);
		$crud->requiredFields(['plan_id', 'client_id', 'status']);

		$crud->fieldType('created', 'hidden');
		$crud->fieldType('consumed', 'hidden');
		$crud->fieldType('available', 'hidden');
		$crud->fieldType('contract_months', 'hidden');
		$crud->fieldType('cycle_start', 'hidden');
		$crud->fieldType('cycle_end', 'hidden');
		$crud->fieldType('status', 'dropdown', array(
			CONTRACT_ACTIVE => ucwords(lang('Hueleanuevo.active')),
			CONTRACT_SUSPENDED => ucwords(lang('Hueleanuevo.suspended')),
			CONTRACT_ENDED => ucwords(lang('Hueleanuevo.ended')),
			CONTRACT_CANCELED => ucwords(lang('Hueleanuevo.canceled')),
		));

		$crud->callbackBeforeInsert(function ($stateParameters) {
			$db      = \Config\Database::connect();
			$builder = $db->table('plan');
			$planDb = $builder->getWhere(['plan_id' => $stateParameters->data['plan_id']])
							  ->getRowArray();

			$stateParameters->data['available'] = intval($planDb['pounds']);
			$stateParameters->data['consumed'] = 0;
			$stateParameters->data['contract_months'] = MINIMUM_CONTRACT_MONTHS;
			$stateParameters->data['created'] = Time::now()->toDateTimeString();
			$stateParameters->data['cycle_start'] = Time::now()->toDateString();
			$stateParameters->data['cycle_end'] = Time::now()->addMonths(1)->toDateString();

			return $stateParameters;
		});

		$crud->unsetExport();
		$crud->unsetEdit();

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
		$crud->displayAs( 'order_id' , 'Orden No.' );
		$crud->displayAs( 'employee_id' , 'Empleado' );
		$crud->displayAs( 'client_id' , 'Cliente' );
		$crud->displayAs( 'price' , 'Precio' );
		$crud->displayAs( 'created' , 'Fecha de Recibido' );
		$crud->displayAs( 'modified' , 'Modificación' );
		$crud->displayAs( 'delivered' , 'Fecha de Entrega' );
		$crud->displayAs( 'status' , 'Estado' );

		$crud->setRelation('employee_id', 'employee', '{lastname} {name}');
		$crud->setRelation('client_id', 'client', '{lastname} {name}');

		$crud->columns(['order_id', 'client_id', 'status', 'employee_id', 'price', 'created', 'delivered']);
		$crud->fields(['employee_id', 'client_id', 'status', 'created', 'delivered']);
		$crud->requiredFields(['employee_id', 'client_id', 'status', 'created', 'delivered']);

		$crud->callbackColumn('price', array($this,'format_currency'));

		$crud->fieldType('status', 'dropdown', array(
			ORDER_STATUS_RECEIVED => ucwords(lang('Hueleanuevo.received')),
			ORDER_STATUS_PROCESSED => ucwords(lang('Hueleanuevo.processed')),
			ORDER_STATUS_DELIVERED => ucwords(lang('Hueleanuevo.delivered')),
			ORDER_STATUS_CANCELED => ucwords(lang('Hueleanuevo.canceled')),
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
		$crud->displayAs( 'status' , 'Estado' );

		$crud->columns(['order_id', 'amount', 'price', 'created', 'status']);
		$crud->fields(['order_id', 'amount', 'price', 'created', 'status']);
		$crud->requiredFields(['order_id', 'amount', 'status']);

		$crud->fieldType('amount', 'integer');
		$crud->fieldType('price', 'hidden');
		$crud->fieldType('created', 'hidden');
		$crud->fieldType('status', 'dropdown', array(
			STATUS_ACTIVE => ucwords(lang('Hueleanuevo.active')),
			STATUS_INACTIVE => ucwords(lang('Hueleanuevo.inactive')),
		));

		$crud->setRelation('order_id', 'order','{order_id}', ['status' => ORDER_STATUS_RECEIVED]);

		$crud->callbackColumn('price', array($this,'format_currency'));

		$crud->callbackBeforeInsert(function ($stateParameters) {
			$db      = \Config\Database::connect();
			$builder = $db->table('plan')
			              ->select('plan.price_pound as plan_price_pound, client_plan.status as client_plan_status')
						  ->join('client_plan', 'plan.plan_id = client_plan.plan_id AND (client_plan.status = ' . CONTRACT_ACTIVE . ' OR client_plan.status = ' . CONTRACT_SUSPENDED . ' )')
						  ->join('order', 'order.client_id = client_plan.client_id AND order.status = ' . ORDER_STATUS_RECEIVED );
			$planDb = $builder->getWhere([
									'order.order_id' => $stateParameters->data['order_id'],
									'plan.status' => STATUS_ACTIVE
								])
							  ->getRowArray();
			
			$poundPrice = DEFAULT_POUND_PRICE;
			if ( !empty($planDb) ) {
				if ($planDb['client_plan_status'] == CONTRACT_ACTIVE) {
					$poundPrice = $planDb['plan_price_pound'];
				}
			}
			
			$stateParameters->data['price'] = round(($stateParameters->data['amount'] * $poundPrice), 2);
			$stateParameters->data['created'] = Time::now()->toDateTimeString();

			return $stateParameters;
		});

		$crud->callbackAfterInsert(function ($stateParameters) {
			$db      = \Config\Database::connect();

			$builder = $db->table('client_plan');
			$clientPlan = $builder->select('client_plan.client_id, client_plan.plan_id')
						  ->join('order', 'order.client_id = client_plan.client_id AND order.status = ' . ORDER_STATUS_RECEIVED )
			              ->getWhere([
									'order.order_id' => $stateParameters->data['order_id']
							])
						  ->getRowArray();


			$db->transStart();
				if ( !empty($clientPlan) ) {
					$builder = $db->table('client_plan')
								->set('available', 'available - ' . (int) $stateParameters->data['amount'], FALSE)
								->set('consumed', 'consumed + ' . (int) $stateParameters->data['amount'], FALSE)
								->set('modified', Time::now()->toDateTimeString())
								->where([
									'client_id' => $clientPlan['client_id'],
									'plan_id' => $clientPlan['plan_id'],
									'status' => CONTRACT_ACTIVE
								])
								->update();
				}
				$builder = $db->table('order')
							->set('price', 'price + ' . (double) $stateParameters->data['price'], FALSE)
							->set('modified', Time::now()->toDateTimeString())
							->where([
								'order_id' => $stateParameters->data['order_id']
							])
							->update();
			$db->transComplete();
					
			return $stateParameters;
		});

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

	// // Validations
	// public function client_is_available_for_any_plan (string $str, string &$error = null): bool {
	// 	$db = \Config\Database::connect();
	// 	$builder = $db->table('client_plan');
	// 	$currentPlanExist = $builder->getWhere([
	// 							'client_id' => $stateParameters->data['client_id'],
	// 							'status' => CONTRACT_ACTIVE || CONTRACT_SUSPENDED,
	// 						])
	// 						->getRowArray();
		
	// 	if ( !empty($currentPlanExist) ) {
	// 		// $error = lang('myerrors.evenError');
	// 		$error = "La falla";
	// 		return false;
	// 	}
	// 	return true;
	// }

	// Callbacks
	public function format_currency($value, $row){
		return number_format($value, 2);
	}
}
