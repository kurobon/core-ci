<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_unit extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	
	
	function get_unit( $object = array(), $limit = NULL, $offset = NULL, $order = array(), $status = NULL ){
		if(!is_null($object)) {
			foreach($object as $row => $val)
			{
				
				if(preg_match("/(<=|>=|=|<|>|!=)(\s*)(.+)/i", trim($val), $matches)){
					$this->db->where( $row .' '.$matches[1], $matches[3]);
				} else {
					$this->db->where( $row .' LIKE', '%'.$val.'%');
				}					
			}
		}	
		
		if(!is_null($limit) && !is_null($offset)){
			$this->db->limit($limit, $offset );
		} 
		
		if(!empty($order)){
			foreach($order as $row => $val)
			{
				$ordered = (isset($val)) ? $val : 'ASC';
				$this->db->order_by($row, $val);
			}
		}      
	  
		if(is_null($status)){
			$query = $this->db->get( 'sys_unit' );
			if ( $query->num_rows() > 0 ) return $query;
			return NULL;
		} else if($status == 'counter'){
			return $this->db->count_all_results('sys_unit');
		}
	}
	
	function input_unit($data){
		$this->db->trans_begin();
		
		$this->db->insert('sys_unit', $data ); 
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}
		else
		{
			$this->db->trans_commit();
			return TRUE;
		}
	}
	
	function update_unit($data, $filter){
		$this->db->trans_begin();
		
		$this->db->update('sys_unit', $data , $filter ); 
				
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}
		else
		{
			$this->db->trans_commit();
			return TRUE;
		}
	}
	
	function delete_unit($filter){	
		$this->db->trans_begin();
		
		$this->db->delete('sys_unit', $filter); 
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}
		else
		{
			$this->db->trans_commit();
			return TRUE;
		}
	}
	
}