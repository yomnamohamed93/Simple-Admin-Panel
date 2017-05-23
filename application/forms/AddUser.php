<?php

class Application_Form_AddUser extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
              // Set the method for the display form to POST
      $this->setMethod('post');

      // Add an user_name element
      $this->addElement('text', 'username', array(
          'label'      => 'Username:',
          'required'   => true,
          'filters'    => array('StringTrim'),
      ));

      // Add the password element
      $this->addElement('password', 'password', array(
      'label' => 'Password:',
      'required' => true,
      ));

      $this->addElement('checkbox', 'pages',array(
              'label' => 'can access pages?',
              'name' => 'access_pages',
              'disableHidden' => true
            )
            );
      $this->addElement('checkbox', 'news',array(
              'label' => 'can access news?',
              'name' => 'access_news',
              'disableHidden' => true
            )
            );
      $this->addElement('checkbox', 'users',array(
              'label' => 'can access users?',
              'name' => 'access_users',
              'disableHidden' => true
            )
            );
      $this->addElement('checkbox', 'settings',array(
              'label' => 'can access settings?',
              'name' => 'access_settings',
              'disableHidden' => true
            )
            );
      // Add the submit button
      $this->addElement('submit', 'submit', array(
          'ignore'   => true,
          'label'    => 'Add User',
      ));
    }


}
