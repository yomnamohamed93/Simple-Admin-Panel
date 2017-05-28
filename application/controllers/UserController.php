<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        $this->user_model = new Application_Model_User();
        if (isset($_SESSION['user'])) {
          $user = $_SESSION['user'];
          $this->view->permession = $user['access_users'];
        }

    }
    public function indexAction()
    {
      if (isset($_SESSION['user'])) {
        $result = $this->user_model->listUsers();
        $page=$this->_getParam('page',1);
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        $this->view->users=$paginator;
      }
      else {
             $this->redirect('Index/login/');
           }
        // $this->view->users = $result;
    }

    public function addAction()
    {
      if (isset($_SESSION['user'])) {
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
                      $this->redirect('user/index');
                  }
                  else {
                    $this->view->error = "something wrong";
                  }
             }
         }
            // $this->render('add');
              $this->view->form = $form;
        }
        else
          {
            $this->redirect('Index/login/');
            }
      }

    public function editAction()
    {
        if (isset($_SESSION['user'])) {
          $id = $this->_request->getParam('user_id');

          $user = $this->user_model->fetchRow($this->user_model->select()->where("user_id=?", $id));

          if ($this->getRequest()->isPost()) {
                  $params = $this->_request->getParams();

                  //filter request parameters
                   unset($params['controller'],$params['action'],
                   $params['module'],$params['submit']);
                  $params['password']=sha1($params['password']);

                   if ($this->user_model->editUser($params,$params['user_id'])) {
                     $this->view->params = $params;
                       $this->redirect('user/index');
                   }
                   else {
                     $this->view->error = "something wrong";
                   }
          }
          $this->view->user = $user;
          $this->render('edit');
        }else {
               $this->redirect('Index/login/');
             }
    }

    public function deleteAction()
    {
        if (isset($_SESSION['user'])) {
          $id = $this->_request->getParam('user_id');
          // echo($id);
          if(  $this->user_model->deleteUser($id))
           $this->redirect('user/index');
      }
       else {
                $this->redirect('Index/login/');
              }
    }

        public function logoutAction()
        {
          session_destroy();
          $this->redirect('/');
        }

}
