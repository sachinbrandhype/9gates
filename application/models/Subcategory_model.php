<?php

class Subcategory_model extends CI_Model
{

    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function getMenuById($id)
    {

        return $this->db->get_where('menu', array('id' => $id))->row();

    }

    function fetch_CategoryByMenu($category)
    {
        $this->db->where('menu', $category);
        $query = $this->db->get('category');
        $output = '<option value="">Select category</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->category.'</option>';
        }
        return $output;
    }
    
    public function iud_data($sql,$value)
    {
        $qr=$this->db->query($sql,$value);

        if($qr)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function insertCSV($data)
    {
        $this->db->insert('subcategory', $data);
        return TRUE;
    }

    function update($id)
    {
        $subid = $this->input->post('id');
        $arr['menu'] = $this->input->post('menu');
        $arr['category'] = $this->input->post('category');
        $arr['subcategory'] = $this->input->post('subcategory');
        $arr['description'] = $this->input->post('description');
        $arr['url'] = $this->input->post('url');
        $arr['modifydate'] = date("Y-m-d H:i:s");
        if (isset($_FILES['image']['name'])) {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms') . '_' . rand(1, 999999);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                //$arr['image'] =
            }
        }

        $count = count($_FILES['bannerimage']['name']);

        for($i=0;$i<$count;$i++){

            if(!empty($_FILES['bannerimage']['name'][$i])){

                $_FILES['file']['name'] = $_FILES['bannerimage']['name'][$i];
                $_FILES['file']['type'] = $_FILES['bannerimage']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['bannerimage']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['bannerimage']['error'][$i];
                $_FILES['file']['size'] = $_FILES['bannerimage']['size'][$i];

                //$path3 = "./uploads/product_gallery/";

                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000';
                $config['file_name'] = $_FILES['bannerimage']['name'][$i];

                $this->load->library('upload',$config);

                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $sql2 = "insert into bannerimage(subcategory,image) values(?,?)";
                    $values2 = array($subid,$filename);
                    $this->submodel->iud_data($sql2,$values2);
                }
            }

        }

        $this->db->where(array('has_very' => $id));
        $this->db->update('subcategory', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('subcategory');
    }

    function subcateMultipleImage($id)
    {

        $query = $this->db->query("SELECT * from bannerimage where subcategory ='$id'");
        return $query->result();
    }

    function allSubcategory()
    {

        $query = $this->db->query("SELECT menu.id,menu.menu,category.category,subcategory.has_very,subcategory.createdate,subcategory.subcategory,subcategory.url,subcategory.id FROM subcategory INNER JOIN category ON category.id=subcategory.category INNER JOIN menu ON menu.id= subcategory.menu ORDER BY subcategory.subcategory");
        return $query->result();
    }


    function getSubcatewryDataById($id)
    {

        return $this->db->get_where('subcategory', array('has_very' => $id))->row();

    }

    function  getAllMenu()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('menu')->result();
    }

    function  getAllCategroy()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('category')->result();
    }


    function getAll($limit, $offset)
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('id DESC');
        return $this->db->get('subcategory')->result();
    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('subcategory')->num_rows();
    }


}