<?php

class Country_model extends CI_Model
{

    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function saveState($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function saveCity($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }
    function saveArea($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function fetch_State($country)
    {
        $this->db->where('country', $country);
        $query = $this->db->get('states');
        $output = '<option value="">Select State</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->state.'</option>';
        }
        return $output;
    }

    function fetch_City($state)
    {
        $this->db->where('state', $state);
        $query = $this->db->get('city');
        $output = '<option value="">Select City</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->city.'</option>';
        }
        return $output;
    }

    function update($id)
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['country'] = $this->input->post('country');
        $arr['modifydate'] = date("Y-m-d H:i:s");
        $this->db->where(array('has_very' => $id));
        $this->db->update('country', $arr);
    }

    function updateState($id)
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['country'] = $this->input->post('country');
        $arr['state'] = $this->input->post('state');
        $arr['modifydate'] = date("Y-m-d H:i:s");
        $this->db->where(array('has_very' => $id));
        $this->db->update('states', $arr);
    }
    function updateCity($id)
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['country'] = $this->input->post('country');
        $arr['state'] = $this->input->post('state');
        $arr['city'] = $this->input->post('city');
        $arr['modifydate'] = date("Y-m-d H:i:s");
        $this->db->where(array('has_very' => $id));
        $this->db->update('city', $arr);
    }

    function updateArea($id)
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['country'] = $this->input->post('country');
        $arr['state'] = $this->input->post('state');
        $arr['city'] = $this->input->post('city');
        $arr['area'] = $this->input->post('area');
        $arr['pincode'] = $this->input->post('pincode');
        $arr['modifydate'] = date("Y-m-d H:i:s");
        $this->db->where(array('has_very' => $id));
        $this->db->update('area', $arr);
    }

    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('country');
    }

    function deleteState($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('states');
    }
    function deleteCity($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('city');
    }
    function deleteArea($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('area');
    }
    function getCountryById($id)
    {

        return $this->db->get_where('country', array('has_very' => $id))->row();

    }

    function getStateById($id)
    {

        return $this->db->get_where('states', array('has_very' => $id))->row();

    }
    function getCityById($id)
    {

        return $this->db->get_where('city', array('has_very' => $id))->row();

    }
    function getAreaById($id)
    {

        return $this->db->get_where('area', array('has_very' => $id))->row();

    }

    function allSize()
    {
        $query = $this->db->query("SELECT category.category,size.has_very,size.size,size.createdate,subcategory.subcategory,subcategory.url FROM size INNER JOIN category ON category.id=size.category INNER JOIN subcategory ON subcategory.id=size.subcategory ORDER BY size.id");
        return $query->result();
    }

    function allState()
    {
        $query = $this->db->query("SELECT country.country,states.has_very,states.state,states.createdate,country.id FROM states INNER JOIN country ON country.id=states.country  ORDER BY states.id");
        return $query->result();
    }

    function allCity()
    {
        $query = $this->db->query("SELECT country.country,city.has_very,states.state,city.createdate,country.id, city.city FROM city INNER JOIN country ON country.id=city.country INNER JOIN states ON states.id=city.state ORDER BY city.id");
        return $query->result();
    }

    function allArea()
    {
        $query = $this->db->query("SELECT country.country,area.has_very,states.state,area.createdate,country.id,area.area,area.pincode, city.city FROM area INNER JOIN country ON country.id=area.country INNER JOIN states ON states.id=area.state INNER JOIN city ON city.id=area.city ORDER BY area.id");
        return $query->result();
    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('country')->num_rows();
    }

    function allCountry()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('country')->result();
    }


}