<?php

class Brand_model extends CI_Model
{

    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }


    function update($id)
    {

        $arr['name'] = $this->input->post('brand');
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



        $this->db->where(array('has_very' => $id));
        $this->db->update('brand', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('brand');
    }



    function allSubcategory()
    {

        $query = $this->db->query("SELECT category.category,subcategory.has_very,subcategory.createdate,subcategory.subcategory,subcategory.url,subcategory.id FROM subcategory INNER JOIN category ON category.id=subcategory.category ORDER BY subcategory.subcategory");
        return $query->result();
    }


    function getBrandDataById($id)
    {

        return $this->db->get_where('brand', array('has_very' => $id))->row();

    }



    function getAllCategroy()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('category')->result();
    }

    function allbrand()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('brand')->result();
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
        return $this->db->get('brand')->result();
    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('brand')->num_rows();
    }


}