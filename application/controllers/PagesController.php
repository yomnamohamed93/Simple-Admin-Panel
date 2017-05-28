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
        if (isset($_SESSION['user'])) {
          $result = $this->page_model->listPages();
          $page=$this->_getParam('page',1);
          $paginator = Zend_Paginator::factory($result);
          $paginator->setItemCountPerPage(10);
          $paginator->setCurrentPageNumber($page);

          $this->view->pages=$paginator;
        }
        else {
            $this->redirect('Index/login/');
          }
    }

    public function addAction()
    {
      if (isset($_SESSION['user'])) {
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
      }
      else {
          $this->redirect('Index/login/');
        }
    }

    public function editAction()
    {
      if (isset($_SESSION['user'])) {
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
      else {
          $this->redirect('Index/login/');
        }
    }

    public function deleteAction()
    {
      if (isset($_SESSION['user'])) {
        $id = $this->_request->getParam('p_id');
        // echo($id);
        if($this->page_model->deletePage($id))
         $this->redirect('pages/index');
       }
      else {
           $this->redirect('Index/login/');
         }
    }
}
