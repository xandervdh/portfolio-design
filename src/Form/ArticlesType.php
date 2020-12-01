<?php

namespace App\Form;

use App\Controller\ArticlesController;
use App\Entity\Articles;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use App\Entity\Tag;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tag = new Tag();
        $builder
            ->add('title')
            ->add('link')
            ->add('content', TextareaType::class)
            ->add('imageFile', VichImageType::class)
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name',
                'choice_value' => 'name',
            ])
            /*->add('tags', EntityType::class, [
                'class' => Tag::class,
                'label' => 'tags',
                'multiple' => true,
            ])*/
            /*->add('tags', ChoiceType::class, [
                'choices'   => array('HTML' => 'HTML', 'Javascript' => 'javascript', 'Bootstrap' => 'bootstrap', 'Symfony' => 'symfony', 'PHP' => 'PHP'),
                'required'  => false,
                'expanded' => true,
                //'multiple' => true,
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
