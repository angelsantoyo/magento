<?php
class Chiragdodia_Mymodule_IndexController extends Mage_Core_Controller_Front_Action
{
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
            ->setFormAction( Mage::getUrl('*/index/post') );

        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('catalog/session');
        $this->renderLayout();

    }

    public function insert($post){

        $resource   = Mage::getSingleton('core/resource');
        $write      = Mage::getSingleton('core/resource')->getConnection('core_write');

//        $table      = $resource->getTableName('chiragdodia_mymodule_comments');
        $name       = $post['name'];
        $email      = $post['email'];
        $telephone  = $post['telephone'];
        $comments   = $post['comment'];

//        $query      =  "Insert Into {$table} (guest_name,guest_email,guest_phone,guest_comments,guest_created_at) values (:name,:email,:telephone,:comments, NOW())";
//        $binds      =  array(
//            'name'      => $name,
//            'email'     => $email,
//            'telephone' => $telephone,
//            'comments'  => $comments,
//        );
//
//
//        $write->query($query,$binds);
//        if(isset($name)&&($name!='') && isset($email)&&($email!='')
//            && isset($comments)&&($comments!='') )
//        {
            $commentsModel = Mage::getModel('chiragdodia_mymodule/comment');
            $commentsModel->setData('guest_name', $name)
                ->setGuestEmail($email)
                ->setData('guest_phone', $telephone)
                ->setData('guest_comments', $comments)
                ->setData('guest_created_at', date('Y-m-d h:m:s'));
            $commentsModel->save();
//        }


    }

    public function postAction()
    {

        $post = $this->getRequest()->getPost();

        $this->insert($post);

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

                Mage::getSingleton('customer/session')->addSuccess(Mage::helper('contacts')->__('Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.'));
                $this->_redirect('*/index/');

                return;
            } catch (Exception $e) {

                $translate->setTranslateInline(true);


                Mage::getSingleton('customer/session')->addError(Mage::helper('contacts')->__( $error2 ));
                $this->_redirect('*');
                return;
            }

        } else {
            $this->_redirect('*/*/');
        }
    }

    public function testAction(){
        phpinfo();
    }

}