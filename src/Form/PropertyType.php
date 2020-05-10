<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titel')
            ->add('description')
            ->add('surface')
            ->add('bedroo')
            ->add('rooms')
            ->add('floor')
            ->add('price')
            ->add('heat' , ChoiceType::class,[
                'choices' => $this-> getChoices()
            ])
            ->add('imageFile', FileType::class ,[
                'required'=> false
            ])
            ->add('city')
            ->add('adress')
            ->add('postal_code')
            ->add('sold')
            ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Property::HEAT;
        $output =[];
        foreach($choices as $k=>$v){
            $output[$v]=$k ;
        }
        return $output ;
    }
}
