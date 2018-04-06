<?php

namespace App\Form;

use App\Entity\Benevole;
use App\Entity\Postes;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BenevoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            //->add('dateInscription')
            ->add('dateNaissance', DateType::class, array(
                'widget' => 'single_text',
                //'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'js-datepicker'],
                //'label' => 'Date de naissance (jj/mm/aaaa)',
                'html5' => true))
            ->add('numeroPermisConduire')
            ->add('mail', EmailType::class)
            ->add('telephone')
            ->add('affectation', EntityType::class, [
                'label' => 'Affecté sur poste :',
                'class' => Postes::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false])
            ->add('postesEnCharge',   EntityType::class, array(
                'class'        => 'App\Entity\Postes',
                'query_builder' => function (EntityRepository $er) {return $er->createQueryBuilder('p')
                    ->orderBy('p.nom', 'ASC');},
                'choice_label' => 'nom',
                'multiple'     => 'true',
                'expanded'     => 'true',
                'label' => 'Postes en charge',
                'required' => false))
            ->add('save', submitType::class, ['label' => 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Benevole::class,
        ]);
    }


}
