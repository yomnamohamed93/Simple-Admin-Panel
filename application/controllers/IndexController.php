<?php

class IndexController extends Zend_Controller_Action
{

  public function init()
  {
    $this->user_model = new Application_Model_User();
    $request = $this->getRequest();

  }

  public function indexAction()
  {

    if (isset($_SESSION['user'])) {
      $user=$_SESSION['user'];

    }
    else {
      $this->render('login');
    }

  }

  public function loginAction()
  {
    var_dump($this->_request->getParams());
    if ($this->getRequest()->isPost() &&
    $this->_request->getParam('username') &&
    $this->_request->getParam('password')
  ){

    $username= $this->_request->getParam('username');
    $password= $this->_request->getParam('password');
    // get the default db adapter
    $db = Zend_Db_Table::getDefaultAdapter();
    //create the auth adapter
    $authAdapter = new Zend_Auth_Adapter_DbTable($db,'users','username', 'password');
    //set the email and password
    $authAdapter->setIdentity($username);
    $authAdapter->setCredential(sha1($password));

    //authenticate
    $result = $authAdapter->authenticate();
    if ($result->isValid()) {
      // $_SESSION['username'] = $username;
      $user = $this->user_model->fetchRow($this->user_model->select()->where("username=?", $username));

      $_SESSION['user'] = $user;
      $this->render('index');
    }else {
      # code...
      echo "invalid data";
    }
  }
  $this->redirect("/");

}


}
