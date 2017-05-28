<?php

class SettingsController extends Zend_Controller_Action
{

    public function init()
    {
        $this->settings_model = new Application_Model_Settings();
        if (isset($_SESSION['user'])) {
          $user = $_SESSION['user'];
          $this->view->permession = $user['access_settings'];
        }

    }

    public function indexAction()
    {
        if (isset($_SESSION['user'])) {
          $this->view->settings = $this->settings_model->listSettings();
          $this->render('index');
        }
       else {
            $this->redirect('Index/login/');
          }
    }

    public function editAction()
    {
      if (isset($_SESSION['user'])) {
        $setting = $this->settings_model->fetchRow($this->settings_model->select()->where("id=?", 1));
        if ($this->getRequest()->isPost()) {
              $params = $this->_request->getParams();

              //filter request parameters
               unset($params['controller'],$params['action'],
               $params['module'],$params['submit']);

               $this->settings_model->editSettings($params,1);
                //  $this->view->params = $params;
                   $this->redirect('settings/index');
        }
        $this->view->setting = $setting;
        $this->render('edit');

    }

    else {
      $this->redirect('Index/login/');
    }
}
}
