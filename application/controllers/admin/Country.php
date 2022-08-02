<?php
class Country extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Country_model','countrymodel',true);
    }


    function delete($id)
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
    }
    function editarea($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['area'] =$this->countrymodel->getAreaById($id);
        $data['country'] =$this->countrymodel->allCountry();
        $data['state'] =$this->countrymodel->allState();
        $data['city'] =$this->countrymodel->allCity();
        $this->load->view('admin/area/edit-area',$data);
    }

    function saveCountry()
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

    }

    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['country'] =$this->countrymodel->allCountry();

        $this->load->view('admin/country/index',$data);
    }

    function state($offset=0)
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
    }


    function add()
    {
        $this->load->view('admin/country/add-country');
    }

    function add_state()
    {
        $data['country'] =$this->countrymodel->allCountry();
        $this->load->view('admin/state/add-state',$data);
    }

    function add_city()
    {
        $data['country'] =$this->countrymodel->allCountry();
        $data['state'] =$this->countrymodel->allState();
        $this->load->view('admin/city/add-city',$data);
    }
    function add_area()
    {
        $data['country'] =$this->countrymodel->allCountry();
        $data['state'] =$this->countrymodel->allState();
        $data['city'] =$this->countrymodel->allCity();
        $this->load->view('admin/area/add-area',$data);
    }
    function stateById()
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $name=$this->input->post('country');
        if($name)
        {
            echo $this->countrymodel->fetch_State($this->input->post('country'));

        }
    }
    function cityById()
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $name=$this->input->post('state');
        if($name)
        {
            echo $this->countrymodel->fetch_City($this->input->post('state'));

        }
    }


}