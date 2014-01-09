<?php
class User_model extends CI_Model {
     
   
    function isLoggedIn()
	   {

        if($this->session->userdata('logged_in'))
        { return true; } 
      	 else 
      	{ return false; }

	   }
    
     function deleteAccount($username)
    {
      
       $q = $this->db->get_where('users',array('username'=>$username), NULL, FALSE);


       if($q->num_rows()==1)
       {
        //rajouter suppression des simulations
        $this->db->delete('users', array('username' => $username)); 

        return true;
       }
       else
       {

        return false;
       }


    }


     function createAccount($username,$password)
     {

     $this->load->library('encrypt');

     $password = $this->encrypt->sha1($password);

    
    
     $q = $this->db->get_where('users',array('username'=>$username), NULL, FALSE);

     

	     if($q->num_rows()==0)
	     {

	     	$data = array(
	               'username' => $username,
	               'password' => $password,
	            );

	     	 $this->db->insert('users',$data);

	     	return true;
	     }
	     else
	     {

	     	return false;
	     }

     }

     function validCredentials($username,$password)
     {
     $this->load->library('encrypt');

     $password = $this->encrypt->sha1($password);

     $q = $this->db->get_where('users',array('username'=>$username,'password'=>$password), NULL, FALSE);

     if($q->num_rows() > 0)
     {
          $r = $q->result();
          $session_data = array('username' => $r[0]->username,'logged_in' => true);
          $this->session->set_userdata($session_data);
          return true;
     } 
     else 
     { 
      return false; 
     }
	}

	
}
?>