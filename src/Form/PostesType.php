<?php

namespace App\Form;

use App\Entity\Equipes;
use App\Entity\Postes;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('remarque')
            ->add('description')
            ->add('nbBenevoles', TextType::class, ['label' => 'Nombre de bénévoles requis : ', 'required' => false])
            ->add('equipe', EntityType::class, [
                'label' => 'Equipe référente',
                'class' => Equipes::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => true
            ])
            /*->add('chefDePoste',        EntityType::class, array(
                'class'        => 'App\Entity\Benevole',
                'query_builder' => function (EntityRepository $er) {return $er->createQueryBuilder('u')
                    ->orderBy('u.nom', 'ASC');},
                'multiple'     => 'false',
                'expanded'     => 'true',
                'label' => 'Chef de poste'))*/
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Postes::class,
        ]);
    }
}
