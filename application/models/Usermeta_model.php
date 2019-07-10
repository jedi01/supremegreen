<?php

include_once('Crud_model.php');

class Usermeta_model extends Crud_model {

	protected $table = "";
	function __construct() 
	{
		parent::__construct();
		$this->table = "usermeta";
		$this->load->model("Crud_model","crud");
	}


		public function manage_user_meta($meta_data,$user_id){


		$where['user_id'] = $user_id;

		foreach ($meta_data as $key => $value) {
			
			$where['meta_key'] = $key;

			$res = $this->crud->get_data("*",$this->table,$where,true);

			$data['meta_key'] = $key;
			$data['meta_value']  = $value;
			$data['user_id'] = $user_id;


			if ($res) {

				$where_meta['umeta_id'] = $res->umeta_id;

				$res = $this->crud->update_data($where_meta,$data,"usermeta");
	
				
			}else{
	
				$res = $this->crud->add_data($data,"usermeta");


			}


		}


	}

	



}

?>