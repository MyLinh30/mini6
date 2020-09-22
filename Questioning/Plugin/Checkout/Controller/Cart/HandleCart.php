<?php


namespace Magenest\Questioning\Plugin\Checkout\Controller\Cart;
use Magento\Framework\Controller\Result\RedirectFactory;

class HandleCart
{
    protected $_url;
    protected $redirectFactory;
    /**
     * @var \Magento\Framework\App\Response\RedirectInterface
     */
    public function __construct(\Magento\Framework\UrlInterface $url,
                                RedirectFactory $redirectFactory){
        $this->_url = $url;
        $this->redirectFactory = $redirectFactory;
    }
    public function aroundExecute(\Magento\Checkout\Controller\Cart\Add $add, callable $proceed)
    {
        $qty = $add->getRequest()->getParam('qty');
        if($qty > 1)
        {
            $urlCustom  = $this->_url->getUrl('checkout/cart/index', ['_secure' => true]);
            return $this->redirectFactory->create()->setPath('checkout/cart/index');
        }else{
            return $proceed();
        }
    }

}
