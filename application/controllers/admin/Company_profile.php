<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Company_profile extends CI_Controller
	{

		function __construct(){
			parent::__construct();	
      $this->load->library('session');
			$this->load->model('company_profile_model');
      $this->load->model('akun_model');

		}

	function index(){

			$data['company'] = $this->company_profile_model->ambil_company_id('1');
      $data['user'] =  $this->akun_model->get_user_by_id($this->session->userdata('id'));
			$this->load->view('backend/company_profile' , $data);		
		}
    /*function ambil_rekening(){
     // $data = $this->db->get_where('company_profile' , array('company_id' => '1'));
      $data = $this->company_profile_model->ambil_company_id('1');
      $rekeningHtml = '';
      foreach ($data as $data1) {
        $rekeningArray = explode(",", $data1->rekening);
        $count = 1;

        for ($i=0; $i <count($rekeningArray) ; $i++) { 
          $button = '';
            if($count > 1)
            {
              $button = '<button type="button" name="remove" id="'.$count.'" class="btn btn-danger btn-xs remove" ">x</button>';
            }
            else
            {
                            $button = '<button type="button" name="remove" id="'.$count.'" class="btn btn-danger btn-xs remove" ">x</button>';            }
            $rekeningHtml = '<div id="row'.$count.'">';
            $rekeningHtml .= '<div class="form-group" style="margin: 5px;"><div id="rekening2"><div class="col-lg-8"><input type="text" placeholder="BRI - 0123123131 - Atas Nama aaa" id="rekening" name="rekening[]" class="form-control" style="margin-bottom : 10px" value="'.$rekeningArray[$i].'"> </div><div class="col-lg-1">'.$button.'</div></div></div></div>';
            $count++;

        }
      }
      $output['rekeningHtml'] = $rekeningHtml;
      $output['rekeningArray'] = $rekeningArray;

      echo json_encode($output);
    }*/
	function update_company(){
        $post = $this->input->post();
        $rekening = $post['rekening'];
        /*$data = array(
                  'nama' =>$this->input->post('nama'),
                  'alamat' => $this->input->post('alamat'),
                  'email' => $this->input->post('email'),
                  'id_provinsi' => $this->input->post('id_provinsi'),
                  'id_kota' => $this->input->post('id_kota'),
                  'rekening' => $rekening,
                );
        $this->load->view('backend/coba' , $data); */       
        //print_r($rekening);


        $config['upload_path'] = './assets/uploads/'.$file['file_name']; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
        $config['max_size'] = '0'; //maksimum besar file 2M
        $config['file_name'] = $this->input->post('logo'); //nama yang terupload nantinya
        $this->load->library('upload' , $config);
        $this->upload->initialize($config);
        
        if(empty($_FILES['logo']['name']))
        {
                $data = array(
                  'nama' =>$this->input->post('nama'),
                  'alamat' => $this->input->post('alamat'),
                  'email' => $this->input->post('email'),
                  'id_provinsi' => $this->input->post('id_provinsi'),
                  'id_kota' => $this->input->post('id_kota'),
                  'rekening' => implode(",", $rekening),

                );
                //$this->load->model('upload_unit_model');
                $this->company_profile_model->update_company(array('company_id' => '1') , $data); //akses model untuk 
                redirect('admin/dashboard'); //jika berhasil maka akan ditampilkan view
                //echo json_encode(array("status" => TRUE));

        }
        elseif (isset($_FILES['logo']['name'])) {
          if ($this->upload->do_upload('logo'))
            {
                $file = $this->upload->data();

                $config['image_library']='gd2';
                $config['source_image']='./assets/uploads/'.$file['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 200;
                $config['height']= 200;
                $config['new_image']= './assets/uploads/'.$file['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data = array(
                  'nama' =>$this->input->post('nama'),
                  'alamat' => $this->input->post('alamat'),
                  'email' => $this->input->post('email'),
                  'logo' => $file['file_name'], 
                  'id_provinsi' => $this->input->post('id_provinsi'),
                  'id_kota' => $this->input->post('id_kota'),
                  'rekening' => implode(",", $rekening),
               
                );
                //$this->load->model('upload_unit_model');
                $this->company_profile_model->update_company(array('company_id' => '1') , $data); //akses model untuk 
                redirect('admin/dashboard'); //jika berhasil maka akan ditampilkan view 
                //echo json_encode(array("status" => TRUE));

              }
            }
            else{
              $error = array('error' => $this->upload->display_errors());
              $this->load->view('dashboard/admin/company_profile', $error);
            }

    	}

    function _api_ongkir($data)
   {
      $curl = curl_init();

    curl_setopt_array($curl, array(
      //CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=12",
      //CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
      CURLOPT_URL => "http://api.rajaongkir.com/starter/".$data,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",     
      CURLOPT_HTTPHEADER => array(
        /* masukan api key disini*/
        "key:7ab02cf76cf243a3457dbf774b51499f"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return  $err;
    } else {
      //print_r($response);
      return $response;
    }
   }


  public function provinsi()
  {

    $provinsi = $this->_api_ongkir('province');
    $data = json_decode($provinsi, true);
    echo json_encode($data['rajaongkir']['results']);
  }
  public function kota($provinsi="")
  {
    if(!empty($provinsi))
    {
      if(is_numeric($provinsi))
      {
        $kota = $this->_api_ongkir('city?province='.$provinsi); 
        $data = json_decode($kota, true);
        echo json_encode($data['rajaongkir']['results']);                
      }
      else
      {
        show_404();
      }
    }
     else
     {
      show_404();
     }
  }
  
	

	}
?>