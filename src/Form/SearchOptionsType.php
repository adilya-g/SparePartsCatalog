<?php

namespace App\Form;

use App\DTO\SearchOptions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchOptionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('searchQuery', TextType::class, [
                'required' => false,
                'label' => 'Поиск',
                'attr' => ['placeholder' => 'Введите текст для поиска...'],
            ])
            ->add('combineName', TextType::class, [
                'required' => false,
                'label' => 'Имя комбайна',
            ])
            ->add('typeId', IntegerType::class, [
                'required' => false,
                'label' => 'ID типа',
            ])
            ->add('typeName', TextType::class, [
                'required' => false,
                'label' => 'Название тэга',
            ])
            ->add('tagIdList', ChoiceType::class, [
                'required' => false,
                'label' => 'ID тегов',
            ])
            ->add('combineId', IntegerType::class, [
                'required' => false,
                'label' => 'ID комбайна',
            ])
            ->add('sortBy', ChoiceType::class, [
                'choices' => [
                    'По дате' => 'date',
                    'По цене' => 'price',
                    'По названию' => 'name',
                ],
                'label' => 'Сортировать по',
            ])
            ->add('sortOrder', ChoiceType::class, [
                'choices' => [
                    'По возрастанию' => 'ASC',
                    'По убыванию' => 'DESC',
                ],
                'label' => 'Направление сортировки',
                'empty_data' => 'ASC',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchOptions::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
