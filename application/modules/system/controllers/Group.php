<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Group extends Auth_Controller {

	function __construct() {
        parent::__construct();
		// loadmodel
		$this->load->model('system/m_group');
		restrict();
    }
	
	public function index()
	{
		
		$tpl['module'] = 'system/Group';
		
		
		$this->template->inject_partial('modules_css', multi_asset( array(
																		'css/components-md.css' => '_theme_',
																		'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css' => '_theme_',
																		), 'css' ) );
																		
		$this->template->inject_partial('modules_js', multi_asset( array(
																'js/datatable.js' => '_theme_',
																'js/metronic.js' => '_theme_',
																'plugins/jquery.blockui.min.js' => '_theme_',
																'plugins/datatables/media/js/jquery.dataTables.min.js' => '_theme_',
																'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js' => '_theme_',
															), 'js' ) );
		$this->template->title( 'Group' );
		$this->template->set_breadcrumb( config_item('app_name') , '' );
		$this->template->set_breadcrumb( 'System' , '' );
		$this->template->set_breadcrumb( 'Group' , 'system/Group/index');
		
		$this->template->build('system/v_group_index', $tpl);
	}
	
	function ajax( $action = NULL )
    {
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		
		if( $action == 'datatables' )
		{
			$columns = array(
				1 => 'GroupName',
				2 => 'GroupDescription'
			);
			
			$object = array();
			if($this->input->post('order_deskGroup') != ''){
				$object['GroupDescription'] = $this->input->post('order_deskGroup');
			}
			
			if($this->input->post('order_namaGroup') != ''){
				$object['GroupName'] = $this->input->post('order_namaGroup');
			}
			
			$order = array();
			if($this->input->post('order')){
				foreach( $this->input->post('order') as $row => $val){
					$order[$columns[$val['column']]] = $val['dir'];
				}
			}
			$length = ($this->input->post('length') == -1) ? NULL : $this->input->post('length');
			
			$qry = $this->m_group->get_group($object, $length, $this->input->post('start'), $order);
			$iTotalRecords = (!is_null($qry)) ? intval($this->m_group->get_group($object, NULL, NULL, NULL, 'counter')) : 0;
			$iDisplayStart = intval($this->input->post('start'));
			$sEcho = intval($this->input->post('draw'));
			
			
			$records = array();
			$records["data"] = array(); 
			if(!is_null($qry)){
				foreach($qry->result_array() as $row){
					$records["data"][] = array(
						'<input type="checkbox" name="id[]" value="'. $row['GroupId'] .'">',
						$row['GroupName'],
						$row['GroupDescription'],
						'<a href="'. site_url( 'system/Group/update/'. $row['GroupId'] ) .'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> Ubah</a>',
					);
				}
			}
			
			
			if ($this->input->post('customActionType') == "group_action") {
				if($this->input->post('customActionName') == 'Delete'){
					$restrict = restrict( 'system/Group/delete', TRUE );
					if($restrict == TRUE){
						foreach($this->input->post('id') as $val){
							$action  = $this->m_group->delete_data_group(array( 'GroupId' => $val ));
						}
						$records["customActionStatus"] = "OK"; 
						$records["customActionMessage"] = "Data group yang anda pilih berhasil dihapus!"; 
					} else {
						$records["customActionStatus"] = "Warning";
						$records["customActionMessage"] = "Maaf, anda tidak memperoleh akses untuk aksi ini!";
					}
				}
			}

			$records["draw"] = $sEcho;
			$records["recordsTotal"] = $iTotalRecords;
			$records["recordsFiltered"] = $iTotalRecords;

			echo json_encode($records);
		}
	}
	
	public function add( )
	{
		$this->load->helper('system/group');
							
		$tpl['module'] = 'system/Group';
		$tpl['group_menu'] = $this->m_group->get_menu(NULL, array('MenuParentId' => 'ASC', 'MenuOrder' => 'ASC', 'MenuName' => 'ASC'));
		#$tpl['group_unit'] = $this->m_group->get_unit(NULL);
		
		$this->form_validation->set_rules('GroupName', 'Nama Group', 'required');
		$this->form_validation->set_rules('GroupDescription', 'Deskripsi Group', 'required');
		$this->form_validation->set_error_delimiters('<div class="help-block col-xs-12 col-sm-reset inline">', '</div>');
		if ($this->form_validation->run()) {
			$save  = array(	
							'GroupName'			=> $this->input->post('GroupName'),
							'GroupDescription'	=> $this->input->post('GroupDescription'),
							'menu' 				=>  (isset($_POST['menu'])) ? $this->input->post('menu') : NULL,
							'datetime' 				=>  date("Y-m-d H:i:s"),
							'userId' 				=>  get_user_name(),
						);
			# print_r($save );
			if( $this->m_group->input_data_group($save) ) {
				$this->session->set_flashdata('message_form', array('status' => 'success', 'title' => 'Informasi', 'message' => 'Data group berhasil disimpan.'));
			} else {
				$this->session->set_flashdata('message_form', array('status' => 'danger', 'title' => 'Peringatan' , 'message' => 'Data group gagal disimpan.'));
			}
			redirect('system/Group');
		} else {
			$this->template->inject_partial('modules_css', multi_asset( array(
																		#'css/JChecktree/jquery-checktree.css' => NULL,
																		), 'css' ) );
																		
			$this->template->inject_partial('modules_js', multi_asset( array(
																	#'js/JChecktree/jquery-checktree.js' => NULL,
																), 'js' ) );
			
			$this->template->title( 'Group' );
			
			$this->template->set_breadcrumb( config_item('app_name') , '' );
			$this->template->set_breadcrumb( 'System' , '' );
			$this->template->set_breadcrumb( 'Group' , 'system/Group/index');
			$this->template->set_breadcrumb( 'Add' , 'system/Group/add/');
			
			$this->template->build('system/v_group_add', $tpl);
		}
	}
	
	public function update( $group_id =  NULL )
	{
		if ( is_null($group_id) ) show_404();
		if(is_null( $data_group = $this->m_group->get_group(array( 'GroupId' => $group_id )))) show_404();
		$this->load->helper('system/group');
		
							
		$tpl['group_data'] = $data_group->row(); ;
		$tpl['module'] = 'system/Group';
		$tpl['group_menu'] = $this->m_group->get_menu(NULL, array('MenuParentId' => 'ASC', 'MenuOrder' => 'ASC', 'MenuName' => 'ASC'));
		$tpl['group_menu_update'] = $this->m_group->get_group_menu(array('GroupDetailGroupId' =>  $group_id ));
		#$tpl['group_unit'] = $this->m_group->get_unit(NULL);
		
		$this->form_validation->set_rules('GroupName', 'Nama Group', 'required');
		$this->form_validation->set_rules('GroupDescription', 'Deskripsi Group', 'required');
		$this->form_validation->set_error_delimiters('<div class="help-block col-xs-12 col-sm-reset inline">', '</div>');
		if ($this->form_validation->run()) {								// validation ok
			$update  = array(	
							'GroupName'			=> $this->input->post('GroupName'),
							'GroupDescription'	=> $this->input->post('GroupDescription'),
							'menu' 				=>  (isset($_POST['menu'])) ? $this->input->post('menu') : NULL,
							'datetime' 				=>  date("Y-m-d H:i:s"),
							'userId' 				=>  get_user_name(),
							'GroupId' 				=>  $group_id,
						);
			if( $this->m_group->update_data_group($update) ) {
				$this->session->set_flashdata('message_form', array('status' => 'success', 'title' => 'Informasi', 'message' => 'Data group berhasil disimpan.'));
			} else {
				$this->session->set_flashdata('message_form', array('status' => 'danger', 'title' => 'Peringatan' , 'message' => 'Data group gagal disimpan.'));
			}
			redirect('system/Group/update/'. $group_id);
		} else {
			$this->template->title( 'Group' );
			$this->template->set_breadcrumb( config_item('app_name') , '' );
			$this->template->set_breadcrumb( 'System' , '' );
			$this->template->set_breadcrumb( 'Group' , 'system/Group/index');
			$this->template->set_breadcrumb( 'Update' , 'system/Group/update/'. $group_id );
			
			$this->template->build('system/v_group_update', $tpl);
		}
		
	}
}