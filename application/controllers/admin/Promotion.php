<?php
class Promotion extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Promotion_model','promotionmodel',true);
    }


    /*function delete($id)
    {
        $this->countrymodel->delete($id);
        $this->session->set_flashdata('success','country deleted successfully');
        redirect('admin/country/index');
    }
    function deletestate($id)
    {
        $this->countrymodel->deleteState($id);
        $this->session->set_flashdata('success','state deleted successfully');
        redirect('admin/country/state');
    }
    function deletecity($id)
    {
        $this->countrymodel->deletecity($id);
        $this->session->set_flashdata('success','city deleted successfully');
        redirect('admin/country/city');
    }

    function deletearea($id)
    {
        $this->countrymodel->deletearea($id);
        $this->session->set_flashdata('success','area deleted successfully');
        redirect('admin/country/area');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->countrymodel->update($id);
        $this->session->set_flashdata('success','Country updated successfully');
        redirect('admin/country/index');

    }

    function updateState($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->countrymodel->updateState($id);
        $this->session->set_flashdata('success','State updated successfully');
        redirect('admin/country/state');

    }
    function updateCity($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->countrymodel->updateCity($id);
        $this->session->set_flashdata('success','City updated successfully');
        redirect('admin/country/city');

    }
    function updatearea($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->countrymodel->updateArea($id);
        $this->session->set_flashdata('success','Area updated successfully');
        redirect('admin/country/area');

    }

    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['country'] =$this->countrymodel->getCountryById($id);
        $this->load->view('admin/country/edit-country',$data);
    }

    function editstate($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['state'] =$this->countrymodel->getStateById($id);
        $data['country'] =$this->countrymodel->allCountry();
        $this->load->view('admin/state/edit-state',$data);
    }
    function editcity($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['city'] =$this->countrymodel->getCityById($id);
        $data['country'] =$this->countrymodel->allCountry();
        $data['state'] =$this->countrymodel->allState();
        $this->load->view('admin/city/edit-city',$data);
    }*/
    
    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['area'] =$this->promotionmodel->getAreaById($id);
        $this->load->view('admin/vouchers/edit',$data);
    }

   /* function saveCountry()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['country'] = $this->input->post('country');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->countrymodel->save('country',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','country saved successfully');
        redirect('admin/country/index');

    }

    function save_state()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['country'] = $this->input->post('country');
        $arr['state'] = $this->input->post('state');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->countrymodel->saveState('states',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','city saved successfully');
        redirect('admin/state/index');

    }
    function save_city()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['country'] = $this->input->post('country');
        $arr['state'] = $this->input->post('state');
        $arr['city'] = $this->input->post('city');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->countrymodel->saveCity('city',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','city saved successfully');
        redirect('admin/country/city');

    }
    function save_area()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['country'] = $this->input->post('country');
        $arr['state'] = $this->input->post('state');
        $arr['city'] = $this->input->post('city');
        $arr['area'] = $this->input->post('area');
        $arr['pincode'] = $this->input->post('pincode');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->countrymodel->saveCity('area',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','area saved successfully');
        redirect('admin/country/area');

    }*/

    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['promotion'] =$this->promotionmodel->allPromotion();

        $this->load->view('admin/vouchers/index',$data);
    }

   /* function state($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['state'] =$this->countrymodel->allState();

        $this->load->view('admin/state/index',$data);
    }

    function city($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['city'] =$this->countrymodel->allCity();

        $this->load->view('admin/city/index',$data);
    }
    function area($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['area'] =$this->countrymodel->allarea();

        $this->load->view('admin/area/index',$data);
    }*/

    
    function save()
    {
        $arr['type'] = $this->input->post('type');
        $arr['name'] = $this->input->post('name');
        $arr['link'] = $this->input->post('link');
        $arr['discount'] = $this->input->post('discount');
        $arr['date'] = date("Y-m-d H:i:s");
        if(isset($_FILES['image']['name']))
        {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
            $config['file_name'] = date('YmdHms').'_'.rand(1,999999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('image'))
            {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                //$arr['image'] =
            }
        }

        $this->promotionmodel->save('promotion_vouchers',$arr);

        $id = $this->db->insert_id();

        redirect('admin/promotion/index');

    }

    function add()
    {
        $this->load->view('admin/vouchers/add');
    }

    

    


}