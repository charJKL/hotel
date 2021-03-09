<?php
namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\ReservationType;

class GroupErrorExtension extends AbstractTypeExtension
{
	const INDEX_NAME = "group_error";
	
	public static function getExtendedTypes(): iterable
	{
		return [ReservationType::class];
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefined([self::INDEX_NAME]);
		$resolver->setAllowedValues(self::INDEX_NAME, true);
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		if(isset($options[self::INDEX_NAME]) === false) return;
		
		$childs = $builder->all();
		foreach($childs as &$child)
		{
			if($child->hasOption("error_bubbling"))
			{
				$child->setErrorBubbling(true);
			}
		}
	}
}