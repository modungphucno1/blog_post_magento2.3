<?php

namespace Stableaddon\RegionalManagement\Controller\Adminhtml\Sub\District\Name;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Magento\Config\Model\Config\Source\Locale;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Stableaddon\RegionalManagement\Model\ResourceModel\SubDistrictName\CollectionFactory;
use Stableaddon\RegionalManagement\Model\Source\SubDistrict;
use Stableaddon\RegionalManagement\Model\SubDistrictName;

/**
 * Class Edit
 *
 * @package Stableaddon\RegionalManagement\Controller\Adminhtml\Sub\District\Name
 */
class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Stableaddon_RegionalManagement::sub_district_name_edit';

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Stableaddon\RegionalManagement\Model\ResourceModel\SubDistrictName\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Edit constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Stableaddon\RegionalManagement\Model\ResourceModel\SubDistrictName\CollectionFactory $collectionFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        CollectionFactory $collectionFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_Customer::customer');

        return $resultPage;
    }

    /**
     * Edit Region page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('district_id');
        $locale = $this->getRequest()->getParam('locale');
        $defaultName = '';
        $collection = $this->collectionFactory->create()
            ->addFieldToFilter('district_id', $id)
            ->addFieldToFilter('locale', $locale);
        $isEdit = (boolean)$collection->count();
        $model = $this->_objectManager->create(SubDistrictName::class);
        $model->setData([]);
        // Initial checking
        if ($isEdit) {
            $model = $collection->getFirstItem();
            if (!$model->getDistrictId()) {
                $this->messageManager->addError(__('This Sub District no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
            $defaultName = $model->getName();
        }

        $FormData = $this->_objectManager->get(Session::class)->getFormData(true);
        if (!empty($FormData)) {
            $model->setData($FormData);
        }

        $this->_coreRegistry->register('regional_management_sub_district_name', $model);

        $countryHelper = $this->_objectManager->get(Locale::class);

        $this->_coreRegistry->register('regional_management_sub_district_name_locale_list', $countryHelper->toOptionArray());
        $regionHelper = $this->_objectManager->get(SubDistrict::class);

        $this->_coreRegistry->register('regional_management_sub_district_name_region_list', $regionHelper->toOptionArray());

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $isEdit ? __('Edit District Name') : __('New Sub District Name'),
            $isEdit ? __('Edit District Name') : __('New Sub District Name')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Sub Districts Name Manager'));
        $resultPage->getConfig()->getTitle()
            ->prepend($isEdit ? __('Edit: %1 (%2)', $defaultName, $id) : __('New Sub District Name'));

        return $resultPage;
    }
}
