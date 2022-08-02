<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!');
class Db_model extends CI_Model
{
    public function __construct()
    {
     parent::__construct();
		 $this->load->database();
		 $this->load->helper('date');
		 $this->load->helper('file');
    }


    public function iud_data($sql,$value)
    {
	       $qr=$this->db->query($sql,$value);
			  $r =$this->db->insert_id();
		      if($qr)
		      {
			       return $r;
		      }
		      else
		      {
			    return 0;
		      } 
    }
	
	public function batch_data($table,$data)
	{
		 $qr = $this->db->insert_batch($table, $data);
		 if($qr)
	      {
		       return 1;
	      }
	      else
	      {
		    return 0;
	      }
		
	}
	
	public function iud_data_id($sql,$value)
	{
		      $qr=$this->db->query($sql,$value);
			  $r =$this->db->insert_id();
		      if($qr)
		      {
			       return $r;
		      }
		      else
		      {
			    return 0;
		      }
	}

	public function iud_insertid_data($sql,$value)
    {
     $qr=$this->db->query($sql,$value);
     $r =$this->db->insert_id();
     if($qr)
     {
        return $r;
     }
     else
     {
        return 0;
     }
   }

	public  function getAlldata($sql)
    {
	$qr = $this->db->query($sql);
	return $qr->result();
    }


	public function total_record_count($sql)
	{
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

     function view_all_data($tname,$limit,$start)
    {
	$this->db->limit($limit, $start);
        $query = $this->db->get($tname);
         if ($query->num_rows() > 0)
	 {
            foreach ($query->result() as $row)
		 {
                $data[] = $row;
             }
            return $data;
        }
        return false;

    }


	function view_all_data2($tname,$id,$limit,$start)
    {
	$this->db->limit($limit, $start);
        $query = $this->db->get_where($tname,$id);
         if ($query->num_rows() > 0)
	 {
            foreach ($query->result() as $row)
		 {
                $data[] = $row;
             }
            return $data;
        }
        return false;

    }

	public function record_count($tname)
	{
        return $this->db->count_all($tname);
         }


	 public function deleteall_data($sql,$id)
	{
		$N = count($id);
             for($i=0; $i < $N; $i++)
             {
			$qr=$this->db->query($sql,array($id[$i]));
	     }
    if($qr)
	{
		return 1;
	}
	else
	{
		return 0;
	}

	}


	public function show_all($tname,$tid,$limit,$start)
	{
	     $this->db->limit($limit, $start);
	     $this->db->select('*');
		 $this->db->from($tname);
             $this->db->where($tid);
             $query = $this->db->get();
		//$query = $this->db->query($sql);
	 if ($query->num_rows() > 0)
	 {
            foreach ($query->result() as $row)
		 {
                $data[] = $row;
             }
            return $data;
        }
        return false;

	}

	public function record_count2($tname,$tid)
	{
		$this->db->select('*');
		 $this->db->from($tname);
             $this->db->where($tid);
		 $query = $this->db->get();
		 $count=0;
		 foreach ($query->result() as $row)
		 {
                $count=$count + 1;
             }
             return  $count;
         }


	 public function deleteall_data_withimage($sql,$sql2,$id)
		 {
			$N = count($id);
             for($i=0; $i < $N; $i++)
             {
			 	$query = $this->db->query($sql2,array($id[$i]));
				$fname=$query->result();
	            $path='./'.$fname[0]->p_img;
	            unlink($path);
				$qr=$this->db->query($sql,array($id[$i]));		   	
		     }
	    if($qr)
		{
			return 1;
		}
		else
		{
			return 0;
		}			 
		}

	 public function deleteall_productdata_withimage($sql,$sql2,$id)
	 {
			$N = count($id);
             for($i=0; $i < $N; $i++)
             {
			 	$query = $this->db->query($sql,array($id[$i]));
				$fname=$query->result();
	            $path1='./includes/uploads/product_featureimage/'.$fname[0]->p_img;
	            $path3='./includes/uploads/product_featureimage/thumbs/'.$fname[0]->p_img;
	            $path2='./'.$fname[0]->p_img_sl;
	            $path4 = './includes/uploads/product_image/'.$id[$i].'-thumbs/';
	            unlink($path1);
	            unlink($path3);
	            delete_files($path2,TRUE);
	            delete_files($path4,TRUE);
				$qr=$this->db->query($sql2,array($id[$i]));
		     }
	    if($qr)
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}

	 public function check($sql)
     {
	    $r=$this->db->query($sql);
	    $r->result();
	    return $r->num_rows();
     }

     public function insert($table,$data)
     {
     	$this->db->insert($table, $data);
     }

     public function update($table,$data,$where)
     {
     	$this->db->where($where);
    	$this->db->update($table, $data);
    	print_r($this->db->last_query());
     }

	 public function insert_data($sql)
     {
	      $qr=$this->db->query($sql);
	      if($qr)
	      {
		       return 1;
	      }
	      else
	      {
		    return 0;
	      }
    }
    
    public function insert_order_detail($data)
	{
		$this->db->insert('order_product', $data);
	}
	
	public function insert_order_status_detail($data)
	{
		$this->db->insert('order_status', $data);
	}
	
	
	function ins_data_check($table,$data,$where='')
    {
		$result = $this->db->get_where($table,$where);
		$inDatabase = (bool)$result->num_rows();
	
		if (!$inDatabase)
		{
			$this->db->insert($table, $data);
		}
    }
	
	public function upload_image($path,$filename='userfile',$type='*',$size='1000')
	{
			      
	              if(!is_dir($path)) 
	              {
	                mkdir($path,0755,TRUE);
	              } 	
					$config['encrypt_name'] =TRUE;
					$config['upload_path'] =$path;
			        $config['allowed_types'] = $type;
					$config['max_size']	= $size;					
			        $config['overwrite'] = FALSE;
					$this->upload->initialize($config);
			        if($this->upload->do_upload($filename))
					{
						$file_data = $this->upload->data();
					    return $file_data['file_name'];
					}
					else
					{
						return 0;
					}
		}
		
		 public function get_ip()
		 {

			//Just get the headers if we can or else use the SERVER global
			if ( function_exists( 'apache_request_headers' ) ) {
	
				$headers = apache_request_headers();
	
			} else {
	
				$headers = $_SERVER;
	
			}
	
			//Get the forwarded IP if it exists
			if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
	
				$the_ip = $headers['X-Forwarded-For'];
	
			} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
			) {
	
				$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
	
			} else {
				
				$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
	
			}
	
			return $the_ip;

	}
	
	
	

}


