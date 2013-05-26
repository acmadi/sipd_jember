<?php

$config = array(
    /**
     * User validation
     */
    'user/edit_account' => array(
        array(
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required'
        ),
        array(
            'field' => 'phone',
            'label' => 'Telepon',
            'rules' => 'required|min_length[6]|max_length[12]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
    ),
    
    'user/add' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|alpha_numeric|min_lenght[5]|is_unique[users.username]'
        ),
        array(
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[5]'
        ),
        array(
            'field' => 'confirmation_password',
            'label' => 'Konfirmasi Password',
            'rules' => 'required|min_length[5]|matches[password]'
        ),
    ),
    
    'user/edit' => array(
        array(
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[5]'
        ),
        array(
            'field' => 'confirmation_password',
            'label' => 'Konfirmasi Password',
            'rules' => 'required|min_length[5]|matches[password]'
        ),
    ),
);
?>
