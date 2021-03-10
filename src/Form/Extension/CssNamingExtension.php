<?php
namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;


class CssNamingExtension extends AbstractTypeExtension
{
	public static function getExtendedTypes(): iterable
	{
		return [DateType::class, SubmitType::class, ChoiceType::class, TextType::class];
	}
	
	public function finishView(FormView $view, FormInterface $form, array $options)
	{
		if($view->parent == null) return;
		
		$formName = $view->parent->vars["name"];
		$fieldName = $view->vars["name"];
		$isInvalidCss = $form->isSubmitted() == true && $form->isValid() == false ? "invalid-value" : "";
		
		if(isset($view->vars["row_attr"]["class"]) == false) $view->vars["row_attr"]["class"] = "";
		if(isset($view->vars["attr"]["class"]) == false) $view->vars["attr"]["class"] = "";
		if(isset($view->vars["label_attr"]["class"]) == false) $view->vars["label_attr"]["class"] = "";
		
		$view->vars["row_attr"]["class"] .= "$formName-row $formName-row-$fieldName $isInvalidCss";
		$view->vars["attr"]["class"] .= "$formName-input $formName-input-$fieldName $isInvalidCss";
		$view->vars["label_attr"]["class"] .= "$formName-label $formName-label-$fieldName $isInvalidCss";
	}
}