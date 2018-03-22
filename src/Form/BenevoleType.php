<?php

namespace App\Form;

use App\Entity\Benevole;
use App\Entity\Postes;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
                'format' => 'dd/MM/yyyy',
                'label' => 'Date de naissance',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false))
            ->add('numeroPermisConduire')
            ->add('mail')
            ->add('affectation', EntityType::class, [
                'label' => 'Affecté sur poste :',
                'class' => Postes::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false])
            ->add('save', submitType::class, ['label' => 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Benevole::class,
        ]);
    }


    /*public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroFacture', TextType::class, ['label'=>'N° Facture'])
            ->add('montantFacture', MoneyType::class, ['label'=>'Montant €HT', 'currency'=>'EUR'])
            ->add('dateFacture', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'label' => 'Date Facture',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false))
            ->add('loueur', EntityType::class, array(
                'label'=>'Loueur',
                'class'=>'PB\CamionBundle\Entity\Loueur',
                'choice_label' => 'nom',
                'multiple'     => false,
                'expanded'     => false))
            ->add('Save',                           SubmitType::class);
    }*/
}
