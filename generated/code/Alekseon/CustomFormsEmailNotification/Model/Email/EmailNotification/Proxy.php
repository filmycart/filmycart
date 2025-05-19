<?php
namespace Alekseon\CustomFormsEmailNotification\Model\Email\EmailNotification;

/**
 * Proxy class for @see \Alekseon\CustomFormsEmailNotification\Model\Email\EmailNotification
 */
class Proxy extends \Alekseon\CustomFormsEmailNotification\Model\Email\EmailNotification implements \Magento\Framework\ObjectManager\NoninterceptableInterface
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Proxied instance name
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Proxied instance
     *
     * @var \Alekseon\CustomFormsEmailNotification\Model\Email\EmailNotification
     */
    protected $_subject = null;

    /**
     * Instance shareability flag
     *
     * @var bool
     */
    protected $_isShared = null;

    /**
     * Proxy constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @param bool $shared
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Alekseon\\CustomFormsEmailNotification\\Model\\Email\\EmailNotification', $shared = true)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->_isShared = $shared;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_subject', '_isShared', '_instanceName'];
    }

    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->_subject = clone $this->_getSubject();
    }

    /**
     * Get proxied instance
     *
     * @return \Alekseon\CustomFormsEmailNotification\Model\Email\EmailNotification
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = true === $this->_isShared
                ? $this->_objectManager->get($this->_instanceName)
                : $this->_objectManager->create($this->_instanceName);
        }
        return $this->_subject;
    }

    /**
     * {@inheritdoc}
     */
    public function getReceiverEmails()
    {
        return $this->_getSubject()->getReceiverEmails();
    }

    /**
     * {@inheritdoc}
     */
    public function getReplyToEmail()
    {
        return $this->_getSubject()->getReplyToEmail();
    }

    /**
     * {@inheritdoc}
     */
    public function getSender()
    {
        return $this->_getSubject()->getSender();
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplateId()
    {
        return $this->_getSubject()->getTemplateId();
    }

    /**
     * {@inheritdoc}
     */
    public function setFormRecord(\Alekseon\CustomFormsBuilder\Model\FormRecord $formRecord)
    {
        return $this->_getSubject()->setFormRecord($formRecord);
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplateParams()
    {
        return $this->_getSubject()->getTemplateParams();
    }

    /**
     * {@inheritdoc}
     */
    public function send()
    {
        return $this->_getSubject()->send();
    }

    /**
     * {@inheritdoc}
     */
    public function sendEmailTemplate()
    {
        return $this->_getSubject()->sendEmailTemplate();
    }
}
