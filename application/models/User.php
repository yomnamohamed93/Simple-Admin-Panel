<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
  //table name
  protected $_name= 'user';
function addUser($data)
{
  $row = $this->createRow();
  $row->user_name = $data['user_name'];
  $row->email = $data['email'];
  $row->password = md5($data['password']);
  return $row->save();
}
function editUser($id, $data){
  $this->update($data, "id=$id");
}
}
