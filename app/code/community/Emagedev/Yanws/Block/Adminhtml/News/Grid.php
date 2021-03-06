<?php

/**
 * Created by PhpStorm.
 * User: skm293504
 * Date: 08.05.15
 * Time: 15:26
 */
class Emagedev_Yanws_Block_Adminhtml_News_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('yanws/news')->getCollection();

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $helper = Mage::helper('yanws');

        $this->addColumn('id', array(
            'header' => $helper->__('ID'),
            'index' => 'id',
            'type' => 'number'
        ));
        $this->addColumn('title', array(
            'header' => $helper->__('Title'),
            'index' => 'title'
        ));
        $this->addColumn('article', array(
            'header' => $helper->__('Content'),
            'index' => 'article',
            'renderer' => 'Emagedev_Yanws_Block_Adminhtml_News_Renderer_Article'
        ));
        $this->addColumn('is_shorten', array(
            'header' => $helper->__('Use shorten s'),
            'index' => 'is_shorten',
            'type' => 'radio',
            'renderer' => 'Emagedev_Yanws_Block_Adminhtml_News_Renderer_Checkbox',
            'value' => array('1')
        ));
        $this->addColumn('shorten_article', array(
            'header' => $helper->__('Shorten'),
            'index' => 'shorten_article',
            'renderer' => 'Emagedev_Yanws_Block_Adminhtml_News_Renderer_Article'
        ));
        $this->addColumn('is_published', array(
            'header' => $helper->__('Is published s'),
            'index' => 'is_published',
            'type' => 'radio',
            'renderer' => 'Emagedev_Yanws_Block_Adminhtml_News_Renderer_Checkbox',
            'value' => array('1')
        ));
        $this->addColumn('url', array(
            'header' => $helper->__('URL'),
            'index' => 'url',
            'type' => 'text'
        ));
        $this->addColumn('timestamp_created', array(
            'header' => $helper->__('Created'),
            'index' => 'timestamp_created',
            'type' => 'datetime'
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('Yanws');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),

            // TODO: Use own helper
            'confirm' => Mage::helper('adminnotification')->__('Are you sure?')
        ));
        return $this;
    }

    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $model->getId(),
        ));
    }
} 