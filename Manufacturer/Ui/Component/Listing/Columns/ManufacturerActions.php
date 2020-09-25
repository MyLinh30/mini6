<?php


namespace Magenest\Manufacturer\Ui\Component\Listing\Columns;


use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class ManufacturerActions extends Column
{
  protected $urlBuilder;
  public function __construct(ContextInterface $context, UrlInterface $urluilder, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
  {
      $this->urlBuilder = $urluilder;
      parent::__construct($context, $uiComponentFactory, $components, $data);
  }
  public function prepareDataSource(array $dataSource)
  {
      if (isset($dataSource['data']['items'])) {
          $storeid = $this->context->getFilterParam('store_id');
          foreach ($dataSource['data']['items'] as &$item) {
              $item[$this->getData('name')]['edit'] = [
                  'href' => $this->urlBuilder->getUrl(
                      'manufacturer/manufacturer/add',
                      ['id' => $item['entity_id'], 'store' => $storeid]
                  ),
                  'label' => __('Edit'),
                  'hidden' => false,
                  '__disableTmpl' => true
              ];
          }
      }
      return $dataSource;
  }
}
