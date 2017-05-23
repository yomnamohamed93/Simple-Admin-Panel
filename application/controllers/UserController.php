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
                    $this->redirect('user/list');
                }
                else {
                  $this->view->error = "something wrong";
                }
           }
       }
          // $this->render('add');
            $this->view->form = $form;
    }

    public function editAction()
    {
        $id = $this->_request->getParam('user_id');
        // echo "$id";
        $user = $this->user_model->fetchRow($this->user_model->select()->where("user_id=?", $id));
        // $params = $this->_request->getParams();
        // var_dump($user);
        // $this->user_model->editUser($user,$id);
        if ($this->getRequest()->isPost()) {
                $params = $this->_request->getParams();

                //filter request parameters
                 unset($params['controller'],$params['action'],
                 $params['module'],$params['submit']);
                 $params['password']=sha1($params['password']);
                // var_dump($params);
                // $this->user_model->editUser($params,$params['user_id']);
                //  $this->view->params = $params;
                 if ($this->user_model->editUser($params,$params['user_id'])) {
                   $this->view->params = $params;
                     $this->redirect('user/list');
                 }
                 else {
                   $this->view->error = "something wrong";
                 }
        }
        $this->view->user = $user;
        $this->render('edit');
    }

    public function listAction()
    {
        $this->view->users = $this->user_model->listUsers();
    }

    public function deleteAction()
    {
        $id = $this->_request->getParam('user_id');
        // echo($id);
        if(  $this->user_model->deleteUser($id))
         $this->redirect('user/list');
    }


}
