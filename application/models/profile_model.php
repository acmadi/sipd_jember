<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Profile_model extends App_Model {

  public $table = 'profiles';

  function __construct() {
    parent::__construct();
  }

  function get_all($conditions = array(), $count = FALSE, $limit = NULL, $offset = NULL) {
    $this->db->select('*')
            ->from($this->table);
    
    if (!empty($conditions)) {
      $this->db->where($conditions);
    }

    if (!empty($limit) || !empty($offset)) {
      $this->db->limit($limit, $offset);
    }

    if ($count) {
      $profiles = $this->db->count_all_results();
    } else {
      $profiles = $this->db->get()->result();
    }
    return $profiles;
  }

  function save($data = array(), $id = NULL, $primary_key = 'id') {
    if (empty($id)) {
      $insert = $this->setInsertData($data);
      return $this->db->insert($this->table, $insert);
    } else {
      $this->db->where($primary_key, $id);
      $update = $this->setUpdateData($data);
      return $this->db->update($this->table, $update);
    }
  }

  function remove($id = NULL, $field = 'id') {
    return $this->db->delete($this->table, array($field => $id));
  }

}

?>