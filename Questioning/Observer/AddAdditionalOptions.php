<?php


namespace Magenest\Questioning\Observer;


use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Serialize\Serializer\Json;

class AddAdditionalOptions implements ObserverInterface
{

    protected $_request;
    public function __construct(RequestInterface $request, Json $serializer = null)
    {
        $this->_request = $request;
        $this->serializer = $serializer ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(Json::class);
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->_request->getFullActionName() == 'checkout_cart_add')
        {
            $product = $observer->getData('product');
            $additionalOptions = [];
            $additionalOptions[] = array(
                'label' => "Question special title",
                'value' => $product['question'],
            );
            $product->addCustomOption('additional_options', $this->serializer->serialize($additionalOptions));
        }
    }
}
