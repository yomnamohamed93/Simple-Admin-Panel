<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
  //table name
  protected $_name= 'users';

function addUser($data)
{
  if(!isset($data['access_pages'])){
    $data['access_pages']='0';
  }
  if(!isset($data['access_news'])){
    $data['access_news']='0';
  }
  if(!isset($data['access_settings'])){
    $data['access_settings']='0';
  }
  if(!isset($data['access_users'])){
    $data['access_users']='0';
  }
  // var_dump($data);
   return $this->insert($data);
}

function editUser($data,$id ){
  // var_dump($data);
  if($data['access_pages']==''){
    $data['access_pages']='0';
  }
  if($data['access_news']==''){
    $data['access_news']='0';
  }
  if($data['access_settings']==''){
    $data['access_settings']='0';
  }
  if($data['access_users']==''){
    $data['access_users']='0';
  }
  return $this->update($data, "user_id=$id");
}

function getUserById($id){
}

function listUsers(){
  return $this->fetchAll()->toArray();
}

function deleteUser($id){
  return $this->delete("user_id=$id");
}

}
