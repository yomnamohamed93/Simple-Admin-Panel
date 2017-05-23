<?php

class Application_Model_Page extends Zend_Db_Table_Abstract
{
  //table name
  protected $_name= 'pages';

  function addPage($data)
  {
      // var_dump($data);
      if (!empty($data['title']) && !empty($data['content']) ) {
        $this->insert($data);
        return true;
      }
      else return false;
  }

  function editPage($data,$id){
    // var_dump($data);
   $this->update($data,"p_id=$id");
  }
  function listPages(){
    return $this->fetchAll()->toArray();
  }

  function deletePage($id){
    return $this->delete("p_id=$id");
  }

}
