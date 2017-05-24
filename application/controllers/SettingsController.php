<?php

class SettingsController extends Zend_Controller_Action
{

    public function init()
    {
        $this->settings_model = new Application_Model_Settings();
        $user=$_SESSION['user'];
        $this->view->permession=$user['access_settings'];

    }

    public function indexAction()
    {
        $this->view->settings = $this->settings_model->listSettings();
        $this->render('index');
    }

    public function editAction()
    {

      $setting = $this->settings_model->fetchRow($this->settings_model->select()->where("id=?", 1));
// var_dump($setting);
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


}
