<?php

class NewsController extends Zend_Controller_Action
{

    public function init()
    {

        $this->news_model = new Application_Model_News();
        if (isset($_SESSION['user'])) {
          $user = $_SESSION['user'];
          $this->view->permession = $user['access_news'];
        }
    }

    public function indexAction()
    {
      if (isset($_SESSION['user'])) {
        $result = $this->news_model->listNews();
        $page=$this->_getParam('page',1);
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        $this->view->news=$paginator;
      }
      else {
        $this->redirect('Index/login/');
      }
    }

    public function addAction()
    {
      if (isset($_SESSION['user'])) {
      // action body
      $request = $this->getRequest();

     if ($this->getRequest()->isPost()) {
             $params = $this->_request->getParams();

             //filter request parameters
              unset($params['controller'],$params['action'],
              $params['module'],$params['submit']);

              if ($this->news_model->addNews($params)) {
                $this->view->params = $params;
                  $this->redirect('news/index');
              }
              else {
                $this->view->error = "Please Fill All Fields";
              }
     }
        $this->render('form');
      }
      else {
        $this->redirect('Index/login/');
      }
          // $this->view->form = $form;
    }

    public function editAction()
    {
      if (isset($_SESSION['user'])) {
        $id = $this->_request->getParam('n_id');
        // echo "$id";
        $news = $this->news_model->fetchRow($this->news_model->select()->where("n_id=?", $id));
        if ($this->getRequest()->isPost()) {
              $params = $this->_request->getParams();

              //filter request parameters
               unset($params['controller'],$params['action'],
               $params['module'],$params['submit']);

               $this->news_model->editNews($params,$params['n_id']);
                //  $this->view->params = $params;
                   $this->redirect('news/index');
        }
        $this->view->news = $news;
        $this->render('form');
      }
      else {
        $this->redirect('Index/login/');
      }
    }

    public function deleteAction()
    {
      if (isset($_SESSION['user'])) {
        $id = $this->_request->getParam('n_id');
        // echo($id);
        if($this->news_model->deleteNews($id))
         $this->redirect('news/index');
     }
     else {
       $this->redirect('Index/login/');
     }
    }


}
