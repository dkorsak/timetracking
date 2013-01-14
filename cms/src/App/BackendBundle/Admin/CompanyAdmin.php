<?php

namespace App\BackendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Admin class for managing companies
 * 
 */
class CompanyAdmin extends Admin
{
    /**
     * @var array
     */
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'name'
    );

    /**
     * {@inheritdoc}
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with("General")
                ->add("name")
                ->add("status", null, array("required" => false))
                ->add("nip")
                ->add("regon")
                ->add("invoiceAddress", null, array("label" => "Invoice address"))
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("name")
            ->add("status");
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }
}