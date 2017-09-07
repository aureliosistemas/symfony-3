<?php

namespace Kod\Bundle\CaixaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LancamentoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	if(!empty($options['caixa'])){
    		die($options['caixa']);
	    }
        $builder->add('produto')->add('valor')->add('data')->add('servico')->add('forma_pagamento')->add('caixa')->add('profissional');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kod\Bundle\CaixaBundle\Entity\Lancamento'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kod_bundle_caixabundle_lancamento';
    }


}
