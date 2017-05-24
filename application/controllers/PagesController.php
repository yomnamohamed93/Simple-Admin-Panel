<?php

class PagesController extends Zend_Controller_Action
{

    public function init()
    {
        $this->page_model = new Application_Model_Page();
        if (isset($_SESSION['user'])) {
          $user = $_SESSION['user'];
          $this->view->permession = $user['access_pages'];
        }

    }

    public function indexAction()
    {
        $result = $this->page_model->listPages();
        $page=$this->_getParam('page',1);
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        $this->view->pages=$paginator;
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

              if ($this->page_model->addPage($params)) {
                $this->view->params = $params;
                  $this->redirect('pages/index');
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

      $id = $this->_request->getParam('p_id');
      // echo "$id";
      $page = $this->page_model->fetchRow($this->page_model->select()->where("p_id=?", $id));
      if ($this->getRequest()->isPost()) {
            $params = $this->_request->getParams();

            //filter request parameters
             unset($params['controller'],$params['action'],
             $params['module'],$params['submit']);

             $this->page_model->editPage($params,$params['p_id']);
              //  $this->view->params = $params;
                 $this->redirect('pages/index');
      }
      $this->view->page = $page;
      $this->render('form');

    }

    public function deleteAction()
    {
      $id = $this->_request->getParam('p_id');
      // echo($id);
      if($this->page_model->deletePage($id))
       $this->redirect('pages/index');
    }


}
