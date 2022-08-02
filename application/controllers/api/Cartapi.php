<?php
require(APPPATH.'/libraries/REST_Controller.php');

class CartApi extends REST_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('CartApiModel');
    }
    
    function addtocart_post()
    {
        echo "okok";
        die();
        
        $datapro['product_id'] = $this->input->post('proid');
        $datapro['user_id'] = $this->input->post('userid');
        $datapro['product'] = $this->input->post('product');
        $datapro['retail'] = $this->input->post('retail');
        $datapro['price'] = $this->input->post('price');
        $datapro['image'] = $this->input->post('image');
        $datapro['qty'] = $this->input->post('qty');
        $datapro['product_url'] = $this->input->post('product_url');
        $datapro['shipping_charge'] = $this->input->post('shipping_charge');
    print_r ("$datapro");
        die();
        $addcartlist = $this->CartApiModel->saveCartList('cart',$datapro);
        if($addcartlist)
        {
            $this->response([
                'Product Add Cart List' => 'ok'
            ], REST_Controller::HTTP_OK);
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
    
}
?>