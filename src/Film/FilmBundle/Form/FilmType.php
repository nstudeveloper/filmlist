<?php

namespace Film\FilmBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('category', 'entity', [
                'class' => 'FilmBundle:Category',
                'multiple' => true
            ])
            ->add('actor', 'entity', [
                'class' => 'FilmBundle:Actor',
                'multiple' => true
            ])
            ->add('image', FileType::class, ['label' => 'upload image', 'data_class' => null, 'required' => false]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Film\FilmBundle\Entity\Film'
        ));
    }
}
