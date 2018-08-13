<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_products extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model');
        $this->load->model('manufacturers_model');
        //copied 
//         $this->load->library('excel');//load PHPExcel library
//         $this->load->model('upload_model');//To Upload file in a directory
//         $this->load->model('excel_data_insert_model');
        
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        $manufacture_id = $this->input->post('manufacture_id');        
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 
        $from=$this->input->post('datefrom');
        $to=$this->input->post('dateto');
        
        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url().'admin/visitors';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
         $data['order_type_selected'] = $order_type;        

        
        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($manufacture_id !== false && $search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
            echo "share entered";
            if($manufacture_id !== 0){
                $filter_session_data['manufacture_selected'] = $manufacture_id;
            }else{
                $manufacture_id = $this->session->userdata('manufacture_selected');
            }
            $data['manufacture_selected'] = $manufacture_id;
            
             
            
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            //fetch manufacturers data into arrays
            $data['manufactures'] = $this->manufacturers_model->get_manufacturers();

            $data['count_products']= $this->products_model->count_products($manufacture_id, $search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            
            if($search_string){
                if($order){
                    $data['products'] = $this->products_model->get_products($manufacture_id, $from, $to, $search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['products'] = $this->products_model->get_products($manufacture_id, $from, $to, $search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['products'] = $this->products_model->get_products($manufacture_id, $from, $to, '', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['products'] = $this->products_model->get_products($manufacture_id, $from, $to, '', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{
            echo "coming to else block";
           

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['manufacture_selected'] = 0;
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
            $data['count_products']= $this->products_model->count_products();
            $data['products'] = $this->products_model->get_products('', '', '','','', $order_type, $config['per_page'],$limit_end); 
            /**
             * for date range search
             */
            if($from !=null && $to !=NULL)
            {
               
                $data['products'] = $this->products_model->get_daterange($from, $to);
                
            }
            $config['total_rows'] = $data['count_products'];

        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/products/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
//             $this->form_validation->set_rules('name', 'name', 'required');
//             $this->form_validation->set_rules('age', 'age', 'required');
//             $this->form_validation->set_rules('phone', 'phone', 'required');
            $this->form_validation->set_rules('belonings', 'belonings', 'required');
              
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
//                     'name' => $this->input->post('name'),
//                     'age' => $this->input->post('age'),
//                     'phone' => $this->input->post('phone'),
//                     'comingfrom' => $this->input->post('comingfrom'),          
//                     'purpose' => $this->input->post('purpose'),
//                     'checkin' => $this->input->post('checkin'),
//                     'address' => $this->input->post('address'),
//                     'adhar' => $this->input->post('adhar'),
//                     'email' => $this->input->post('email'),
                    'belongings' => $this->input->post('belonings')
                );
                //if the insert has returned true then we show the flash message
                if($this->products_model->store_belongings($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //fetch manufactures data to populate the select field
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/products/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('age', 'age', 'required|numeric');
            $this->form_validation->set_rules('phone', 'phone', 'required');
            $this->form_validation->set_rules('comingfrom', 'comingfrom', 'required');
          
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'age' => $this->input->post('age'),
                    'phone' => $this->input->post('phone'),
                    'comingfrom' => $this->input->post('comingfrom'),
                    'purpose' => $this->input->post('purpose'),
                    'checkin' => $this->input->post('checkin'),
                    'address' => $this->input->post('address'),
                    'adhar' => $this->input->post('adhar'),
                    'email' => $this->input->post('email'),
                    'belongings' => $this->input->post('belongings')
                );
                //if the insert has returned true then we show the flash message
                if($this->products_model->update_product($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/visitors/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['product'] = $this->products_model->get_product_by_id($id);
        //fetch manufactures data to populate the select field
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/products/edit';
        $this->load->view('includes/template', $data);            

    }//update
    
    /**
     * expoer to excel file
     */
    public function export()
    {
        $this->load->library('excel');
        $output=$this->input->post('exportable');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Exporing');
        $filename='d1.xls';  
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment;filename="'.$filename.'"');  
        header('Cache-Control: max-age=0'); 
        
       
//         echo "i am expoerting";
//         header('Content-Type: application/xls');
//         header('Content-Disposition: attachment; filename=download.xls');
       
       $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
       $objWriter->save('php://output');
//        echo $output;
         
    }//expert
    
    
    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->products_model->delete_product($id);
        redirect('admin/visitors');
    }//edit
    
    
    
   
   
        
        public	function ExcelDataAdd()	{
            //Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)
            $configUpload['upload_path'] = FCPATH.'uploads/excel/';
            $configUpload['allowed_types'] = 'xls|xlsx|csv';
            $configUpload['max_size'] = '5000';
            $this->load->library('upload', $configUpload);
            $this->upload->do_upload('userfile');
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $file_name = $upload_data['file_name']; //uploded file name
            $extension=$upload_data['file_ext'];    // uploded file extension
            
            //$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003
            $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007
            //Set to read only
            $objReader->setReadDataOnly(true);
            //Load excel file
            $objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);
            $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel
            $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);
            //loop from first data untill last data
            for($i=2;$i<=$totalrows;$i++)
            {
                $id= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
                $name= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
                $age= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
                $email=$objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
                $phone=$objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); //Excel Column 4
                $comingfrom= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
                $purpose= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
                $checkin=$objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
                $address=$objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); //Excel Column 4
                $checkout= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
                $adhar= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
                $email=$objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
                $belongings=$objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); //Excel Column 4
                
                $id= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
                $name= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
                $age= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
                $emaile=$objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
                $phone=$objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
                $data_user=array('name'=>$name, 'age'=>$age ,'email'=>$email ,'phone'=>$phone , 'comingfrom'=>$comingfrom,'purpose'=>$purpose ,
                    'checkin'=>$checkin , 'address'=>$address,'checkout'=>$checkout,'adhar'=>$adhar ,'email'=>$email , 'belongings'=>$belongings);
                $this->products_model->Add_User($data_user);
                
                
            }
            unlink('././uploads/excel/'.$file_name); //File Deleted After uploading in database .
            redirect(base_url() . "put link were you want to redirect");
            
            
        }
        

}