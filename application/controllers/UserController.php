<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        $this->user_model = new Application_Model_User();
    }

    public function indexAction()
    {
        // action body
        $this->view->users = $this->user_model->listUsers();
    }

    public function addAction()
    {
        // action body
      $request = $this->getRequest();
       $form    = new Application_Form_AddUser();

       if ($this->getRequest()->isPost()) {
           if ($form->isValid($request->getPost())) {
               $params = $this->_request->getParams();

               //filter request parameters
                unset($params['controller'],$params['action'],
                $params['module'],$params['submit']);
                $params['password']=sha1($params['password']);

                if ($this->user_model->addUser($params)) {
                  $this->view->params = $params;
                }
                if($this->user_model->addUser($params)){
                  $this->view->users = $this->user_model->listUsers();
                }
           }
       }

            $this->view->form = $form;
    }

    public function editAction()
    {
        // action body
    }

    public function listAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }


}
