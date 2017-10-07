<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Auth_Controller {

	private $module = 'dashboard';
	
	
    function __construct() {
        parent::__construct();		
    }
	
	public function index()
	{
		protect_acct();
		
		#$this->template->inject_partial('modules_css', css( 'inbox.css', '_theme_') );
		
		$tpl['module'] = $this->module;
		if ($message = $this->session->flashdata('message')) {
			if(is_array($message)){
				$tpl['message'] = $message;
			} else {
				$tpl['message']['text'] = $message;
				$tpl['message']['status'] = 'info';
			}
		} else {
			$tpl['message'] = NULL;
		}
		
		$this->template->title( 'Selamat Datang' );
		$this->template->set_breadcrumb( 'Beranda' , site_url('dashboard'), 'ace-icon fa fa-home home-icon blue' );
		$this->template->build($this->module. '/v_index', $tpl);
	}
}