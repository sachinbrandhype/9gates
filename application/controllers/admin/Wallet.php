<?php
class Wallet extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Wallet_model','walletmodel',true);
    }


    function delete($id)
    {
        $this->walletmodel->delete($id);
        $this->session->set_flashdata('success','deleted successfully');
        redirect('admin/user/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->walletmodel->update($id);
        $this->session->set_flashdata('success','updated successfully');
        redirect('admin/user/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['user'] =$this->walletmodel->getUserById($id);
        $this->load->view('admin/user/edit-user',$data);
    }


    function save()
    {
        $res=$this->input->post('username');

        $exp=explode("__",$res);


        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['username'] = $exp[0];
        $arr['userid'] = $exp[1];
        $arr['credit_balance'] = $this->input->post('balance');
        $arr['type'] = $this->input->post('type');
        $arr['data_type'] = $this->input->post('data_type');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->walletmodel->save('wallet',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','saved successfully');
        redirect('admin/wallet/credit');

    }

    function saveDebit()
    {
        $res=$this->input->post('username');

        $exp=explode("__",$res);

        $data['user'] =$this->walletmodel->allUser();
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['username'] = $exp[0];
        $arr['userid'] = $exp[1];
        $arr['debit_balance'] = $this->input->post('debit_balance');
        $arr['type'] = $this->input->post('type');
        $arr['data_type'] = $this->input->post('data_type');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->walletmodel->save('wallet',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','saved successfully');
        redirect('admin/wallet/debit');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['credit'] =$this->walletmodel->allCredit();

        $this->load->view('admin/wallet/credit-wallet',$data);
    }


    function credit()
    {
        $data['credit'] =$this->walletmodel->allCredit();
        $data['user'] =$this->walletmodel->allUser();
        $this->load->view('admin/wallet/credit-wallet',$data);
    }

    function debit()
    {
        //error_reporting(0);
        $data['user'] =$this->walletmodel->allUser();
        $data['debit'] =$this->walletmodel->allDebit();
        
        $this->load->view('admin/wallet/debit-wallet',$data);
    }


}