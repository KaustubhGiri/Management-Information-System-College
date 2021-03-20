<?php 
class SessionModel extends CI_model {
    public function check_session(){
        $this->load->helper('url');
        if($this->session->userdata('login')!= 0){
            redirect(base_url().'index.php/Home');
        }
    }

    public function logout(){
        $this->load->helper('url');
        $this->session->unset_userdata('login');
        header("Location: Login");  
            
    }

    public function logoutusr(){
        $this->load->helper('url');
        if(isset($_POST['logout'])){
            $this->logout();
        }
        
    }
    public function not_Session(){
        if($this->session->userdata('login')!= 1){
            header("Location: login");
        }
    }
    public function check_authority($token_name,$switch = FALSE){
        if($switch == FALSE){
            if($this->session->userdata('login')== 1){
                $level=$this->session->userdata('accesslevel');
                $this->db->get_where('accesscontrol', array('access_level' => $this->session->userdata('accesslevel')), 1);
                $res=$this->db->query("select * from accesscontrol where access_level = $level && $token_name = 1");
                if($res->num_rows() <= 0){
                redirect(base_url().'index.php/Home');
                }
            }
        }elseif($switch == TRUE){
            if($this->session->userdata('login')== 1){
                $level=$this->session->userdata('accesslevel');
                $this->db->get_where('accesscontrol', array('access_level' => $this->session->userdata('accesslevel')), 1);
                $res=$this->db->query("select * from accesscontrol where access_level = $level && $token_name = 1");
                if($res->num_rows() <= 0){
                    return FALSE;
                }else{
                    return TRUE;
                }
            }else{
                return FALSE;
            }
        }
    }
    
}