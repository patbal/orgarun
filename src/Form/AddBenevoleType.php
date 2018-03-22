<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddBenevoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('affectation');
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return BenevoleType::class;
    }

}
