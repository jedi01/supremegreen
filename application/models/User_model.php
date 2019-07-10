<?php
include_once('Crud_model.php');
class User_model extends Crud_model{

	protected $table = "";

	public function __construct() {

		$this->table = "users";
		parent::__construct();

	}

	public function login_user($data){
		extract($data);
		$query = $this->db->get_where('users', array('email' => $email,'password' => $password,"role" => $role));
		if($query->num_rows()>0){
			
			$response =  $query->row();
			

			return $response;

		}
		else{
			
			return false;

		}


	}

    public function get_where ($select, $where = '', $return_type = true, $join = array(), $order_by = '', $limit = '', $groupby = '')
    {
        $this->db->select ($select);
        $this->db->from ($this->table);

        if (!empty($join)) {
            foreach ($join as $key => $value) {
                $this->db->join($key,$value);
            }
        }
        
        ($where) ? $this->db->where ($where) : '';
        if ($groupby != '')
            $this->db->group_by ($groupby);
        if ($order_by != '')
            $this->db->order_by ($order_by,"DESC");

        if ($limit != '')
            $this->db->limit ($limit);

        if ($return_type)
        {
            $result = $this->db->get ()->result('array');
        }
        else
        {
            $result = $this->db->get ()->row ();
        }
        return $result;
    }

		public function format_user_data ($user_data,$user_meta)
	{


		foreach ($user_meta as $key => $value) {
			
			$user_data->{$value->meta_key} = $value->meta_value;
		}

		return $user_data;
	}


	public function get_user_meta($meta_key,$user_id)
	{


		$this->db->where(array("meta_key"=>$meta_key,"user_id"=>$user_id));

		$this->db->from("usermeta");
		
		$res =  $this->db->get()->row();

		$value = "";

		if (isset($res->meta_value)) {
			$value = $res->meta_value;
		}

		return $value;

		
	}



}


?>