<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * User model use to add all behavior user
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */

class User_model extends App_Model {

  public $table = 'users';

  function __construct() {
    parent::__construct();
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * @param String $username Username user login
   * @param String $password Password user login
   * @return Array
   * 
   * Description :
   * This function use to validate username and password in database
   */
  function validate($username = NULL, $password = NULL) {
    $data = $this->db->get_where($this->table, array('username' => $username, 'password' => md5($password), 'is_remove' => 0));
    return $data->result();
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * @param array $data
   * @return Boolean
   * 
   * Description :
   * This function use to save data user
   */
  function register($data = array()) {
    $data['is_remove'] = 0;
    $insert = $this->setInsertData($data);
    $return = $this->db->insert($this->table, $insert);
    return $return;
  }
  
  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * @param array $data
   * @param integer $id
   * @param string $primaryKey
   * @return object
   */
  function update($data = array(), $id = NULL, $primaryKey = 'id'){    
    $this->db->where($primaryKey, $id);
    return $this->db->update($this->table, $data); 
  }
  
  function get_by_under_role_level($id = NULL, $count = FALSE, $limit = NULL, $offset = NULL){
    $this->load->model('Role_model', '', TRUE);
    $user_role = $this->Role_model->get_role_by_user_id($id);
    
    $this->db->select('users.*, roles.name AS role_name, sub_districts.name AS sub_district_name')
            ->from($this->table)
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->join('sub_districts', 'sub_districts.id = users.sub_district_id', 'left')
            ->where(array('users.id !=' => $id, 'roles.level >' => $user_role[0]->level));
    
    if(!empty($limit) || !empty($offset)){
      $this->db->limit($limit, $offset);
    }
    if($count){
      $users = $this->db->count_all_results();
    }  else {
      $users = $this->db->get()->result();
    }
    return $users;
  }

}

?>