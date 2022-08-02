<?php
class Coupon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Coupon_model','couponmodel',true);
    }


    function delete($id)
    {
        $this->couponmodel->delete($id);
        $this->session->set_flashdata('success','deleted successfully');
        redirect('admin/coupon/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->couponmodel->update($id);
        $this->session->set_flashdata('success','updated successfully');
        redirect('admin/coupon/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['coupon'] =$this->couponmodel->getCouponById($id);
        $this->load->view('admin/coupon/edit-coupon',$data);
    }


    function save()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));

        $arr['coupon_code'] = $this->input->post('coupon_code');
        $arr['coupon_type'] = $this->input->post('coupon_type');
        $arr['coupon_value'] = $this->input->post('coupon_value');
        $arr['amount'] = $this->input->post('amount');
        $arr['start_date'] = $this->input->post('start_date');
        $arr['end_date'] = $this->input->post('end_date');

        $this->couponmodel->save('coupon',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','saved successfully');
        redirect('admin/coupon/index');

    }

    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['coupon'] =$this->couponmodel->allCoupon();

        $this->load->view('admin/coupon/index',$data);
    }


    function add()
    {
        /*$data['credit'] =$this->couponmodel->allCoupon();*/
        $this->load->view('admin/coupon/add-coupon');
    }



}