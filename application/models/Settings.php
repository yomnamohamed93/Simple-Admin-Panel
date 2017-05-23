<?php

class Application_Model_Settings extends Zend_Db_Table_Abstract
{
  protected $_name= 'settings';

  function editSettings($data,$id){
    // var_dump($data);
   $this->update($data,"id=$id");
  }
  function listSettings(){
    return $this->fetchAll()->toArray();
  }

}
