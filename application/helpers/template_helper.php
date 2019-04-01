<?php  

	function get_template($view){
		$_this =& get_instance();
		return $_this->load->view('backend/'.$view);
	}
	function set_url($sub){
		$_this =& get_instance();
		
		return site_url($sub);
	}

?>
