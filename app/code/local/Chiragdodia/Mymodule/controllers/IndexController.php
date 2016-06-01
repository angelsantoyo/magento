<?php
class Chiragdodia_Mymodule_IndexController extends Mage_Core_Controller_Front_Action
{
    const XML_PATH_EMAIL_RECIPIENT  = 'contacts/email/recipient_email';
    const XML_PATH_EMAIL_SENDER     = 'contacts/email/sender_email_identity';
    const XML_PATH_EMAIL_TEMPLATE   = 'contacts/email/email_template';
    const XML_PATH_ENABLED          = 'contacts/contacts/enabled';

    public function preDispatch()
    {
        parent::preDispatch();

        if( !Mage::getStoreConfigFlag(self::XML_PATH_ENABLED) ) {
            $this->norouteAction();
        }

    }

    public function indexAction()
    {


        $this->loadLayout();
        $this->getLayout()->getBlock('contactForm')
            ->setFormAction( Mage::getUrl('index.php/mymodule/index/post') );

        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('catalog/session');
        $this->renderLayout();

    }
    public function insert(){
        $post = $this->getRequest()->getPost();

        $resource   = Mage::getSingleton('core/resource');
        $write      = Mage::getSingleton('core/resource')->getConnection('core_write');

        $table      = $resource->getTableName('contact_details');
        $subject    = $post['subject'];
        $name       = $post['name'];
        $email      = $post['email'];
        $telephone  = $post['telephone'];
        $comments   = $post['comments'];

        $query      =  "Insert Into {$table} (subject,name,email,telephone,comment,modified_at) values (:subject,:name,:email,:telephone,:comments, NOW())";


        $binds      =  array(
            'subject'   => $subject,
            'name'      => $name,
            'email'     => $email,
            'telephone' => $telephone,
            'comments'  => $comments
        );

        $write->query($query,$binds);

    }

    public function postAction()
    {
        $this->_redirect('index.php/mymodule/index');
        $post = $this->getRequest()->getPost();

        insert();

        if ( $post ) {
            $translate = Mage::getSingleton('core/translate');
            /* @var $translate Mage_Core_Model_Translate */
            $translate->setTranslateInline(false);
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);

                $error = false;
                $error2 = '';

                if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
                    $error = true;
                    $error2 = 'Please add a contact name for this inquiry.';
                }

                if (!Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                    $error = true;
                    $error2 = 'Please add a valid email address and resubmit the contact form.';
                }

                if (Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
                    $error = true;
                }

                if ($error) {
                    throw new Exception();
                }
                $mailTemplate = Mage::getModel('core/email_template');
                /* @var $mailTemplate Mage_Core_Model_Email_Template */
                $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                    ->setReplyTo($post['email'])
                    ->sendTransactional(
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT),
                        null,
                        array('data' => $postObject)
                    );

                if (!$mailTemplate->getSentSuccess()) {
                    throw new Exception();
                }

                $translate->setTranslateInline(true);

                Mage::getSingleton('customer/session')->addSuccess(Mage::helper('contacts')->__('Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.'));
                $this->_redirect('*/*/*/');

                return;
            } catch (Exception $e) {

                $translate->setTranslateInline(true);


                Mage::getSingleton('customer/session')->addError(Mage::helper('contacts')->__( $error2 ));
                $this->_redirect('*');
                return;
            }

        } else {
            $this->_redirect('*/*/*/');
        }
    }
}