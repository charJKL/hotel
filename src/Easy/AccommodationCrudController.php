<?php

namespace App\Easy;

use App\Entity\Accommodation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class AccommodationCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Accommodation::class;
	}

	public function configureCrud(Crud $crud): Crud
	{
		return $crud->setDefaultSort(["status" => "ASC"]);
	}
	/*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
