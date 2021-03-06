<?php

namespace Stableaddon\RegionalManagement\Plugin\Magento\Quote\Model;

/**
 * Class BillingAddressManagement
 *
 * @package Stableaddon\RegionalManagement\Plugin\Magento\Quote\Model
 */
class BillingAddressManagement
{
    /**
     * @var \Stableaddon\RegionalManagement\Helper\Data
     */
    protected $helper;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * BillingAddressManagement constructor.
     *
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Stableaddon\RegionalManagement\Helper\Data $helper
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Stableaddon\RegionalManagement\Helper\Data $helper
    )
    {
        $this->logger = $logger;
        $this->helper = $helper;
    }

    /**
     * @param \Magento\Quote\Model\BillingAddressManagement $subject
     * @param $cartId
     * @param \Magento\Quote\Api\Data\AddressInterface $address
     * @param bool $useForShipping
     */
    public function beforeAssign(
        \Magento\Quote\Model\BillingAddressManagement $subject,
        $cartId,
        \Magento\Quote\Api\Data\AddressInterface $address,
        $useForShipping = false
    )
    {

        $extAttributes = $address->getExtensionAttributes();
        if (!empty($extAttributes)) {

            foreach ($this->helper->getExtraCheckoutAddressFields('subdistrict_checkout_billing_address_fields') as $extraField) {

                $set = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $extraField)));
                $get = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $extraField)));

                $value = $extAttributes->$get();
                try {
                    if (isset($value) && $value) {
                        $address->$set($value);
                    }
                } catch (\Exception $e) {
                    $this->logger->critical($e->getMessage());
                }
            }
        }

    }
}