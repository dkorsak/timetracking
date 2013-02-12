<?php

namespace App\BackendBundle\Admin;

use App\GeneralBundle\Entity\Company;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Admin class for managing companies
 * 
 */
class ProjectAdmin extends Admin
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
            ->with('General')
                ->add('company', 'sonata_type_model', array('property' => 'name', 'query' => $this->createCompanyQuery()))
                ->add('name')
                ->add('status', null, array('property' => 'name'))
            ->end()
            ->with('Tasks')
                ->add('tasks', 'app_backend_form_project_tasks_type', array('required' => false))
            ->end()
            ->with('Users')
                ->add(
                    'users',
                    'sonata_type_model',
                    array(
                        'label' => ' ',
                        'required' => false,
                        'expanded' => true,
                        'property' => 'name',
                        'by_reference' => false,
                        'multiple' => true,
                        'query' => $this->createUsersQuery()
                    )
                )
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add("company.name")
            ->add("status.name")
            ->add(
                '_action',
                'actions',
                array(
                    'label' => 'Actions',
                    'actions' => array(
                        'view' => array('template' => 'AppBackendBundle:CRUD:list__action_view.html.twig'),
                        'edit' => array('template' => 'AppBackendBundle:CRUD:list__action_edit.html.twig'),
                        'delete' => array('template' => 'AppBackendBundle:CRUD:list__action_delete.html.twig'),
                    )
                )
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('company')
            ->add('status');
    }

    private function createUsersQuery()
    {
        $query = $this->modelManager
            ->getEntityManager('AppGeneralBundle:User')
            ->createQuery('SELECT u FROM AppGeneralBundle:User u ORDER BY u.firstname, u.lastname');
        
        return $query;
    }

    private function createCompanyQuery()
    {
        $query = $this->modelManager
            ->getEntityManager('AppGeneralBundle:Company')
            ->createQuery('SELECT c FROM AppGeneralBundle:Company c WHERE c.status = :status ORDER BY c.name ASC')
            ->setParameter('status', Company::STATUS_ENABLED);
        
        return $query;
    }
}
