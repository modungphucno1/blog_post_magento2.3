<?php

namespace Stableaddon\RegionalManagement\Block\Adminhtml\Sub\District;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

/**
 * Class Edit
 *
 * @package Stableaddon\RegionalManagement\Block\Adminhtml\Sub\District
 */
class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * Edit constructor.
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Department edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'regional_management_sub_district_id';
        $this->_blockGroup = 'Stableaddon_RegionalManagement';
        $this->_controller = 'adminhtml_sub_district';
        parent::_construct();

        if ($this->_isAllowedAction('Stableaddon_RegionalManagement::sub_district_edit')) {
            $this->buttonList->update('save', 'label', __('Save Sub District'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => [
                                'event' => 'saveAndContinueEdit',
                                'target' => '#edit_form'
                            ],
                        ],
                    ]
                ],
                -100
            );

            $region = $this->_coreRegistry->registry('regional_management_sub_district');
            if(!empty($region)) {
                if ($region->getId()) {
                    $this->buttonList->add(
                        'delete',
                        [
                            'label'   => __('Delete'),
                            'class'   => 'delete',
                            'onclick' => 'deleteConfirm("Are you sure you want to delete this Sub District?", "'.$this->getDeleteUrl().'")'
                        ],
                        -100
                    );
                }
            }
        } else {
            $this->buttonList->remove('save');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Retrieve delete Url.
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl(
            '*/*/delete',
            [
                '_current' => true,
                'id' => $this->getRequest()->getParam('id')
            ]
        );
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl(
            '*/*/save',
            [
                '_current' => true,
                'back' => 'edit',
                'active_tab' => ''
            ]
        );
    }
}
