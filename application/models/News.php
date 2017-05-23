<?php

class Application_Model_News extends Zend_Db_Table_Abstract
{
  //table name
  protected $_name= 'news';

  function addNews($data)
  {
      // var_dump($data);
      if (!empty($data['title']) && !empty($data['content']) ) {
        $this->insert($data);
        return true;
      }
      else return false;
  }

  function editNews($data,$id){
    // var_dump($data);
   $this->update($data,"n_id=$id");
  }
  function listNews(){
    return $this->fetchAll()->toArray();
  }

  function deleteNews($id){
    return $this->delete("n_id=$id");
  }


}
