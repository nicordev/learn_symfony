<?php

namespace App\Controller\Admin;

use App\Entity\Child;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChildCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Child::class;
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
