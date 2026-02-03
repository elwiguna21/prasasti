<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datamasterweb extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->library('grocery_CRUD');

	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}


	public function _example_output($output = null)
	{
		//$this->load->view('index');	
		$this->load->view('Panel/example.php',(array)$output);
		//$this->load->view('foot');
	}

	function updatedata(){
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('berkas');
		$crud->set_subject('arsip');
		$crud->set_field_upload('file','assets/data/');
		$crud->set_lang_string('update_success_message',
				 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
				 <script type="text/javascript">
				  window.location ="<?php echo site_url("new_controller"); ?>";
				 </script>
				 <div style="display:none">
				 '
		   );
		$output = $crud->render();
		$this->_example_output($output);
		
	}








}
