<?php

class NewsController extends Zend_Controller_Action
{

    public function init()
    {

        $this->news_model = new Application_Model_News();
        $user=$_SESSION['user'];
        $this->view->permession=$user['access_news'];
    }

    public function indexAction()
    {
        $result = $this->news_model->listNews();
        $page=$this->_getParam('page',1);
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        $this->view->news=$paginator;
    }

    public function addAction()
    {
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
          // $this->view->form = $form;
    }

    public function editAction()
    {

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

    public function deleteAction()
    {
      $id = $this->_request->getParam('n_id');
      // echo($id);
      if($this->news_model->deleteNews($id))
       $this->redirect('news/index');
    }


}
