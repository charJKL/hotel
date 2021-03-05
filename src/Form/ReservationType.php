<?php

namespace App\Form;


use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use App\Form\Transformer\ContactToEmailOrPhoneTransformer;
use App\Entity\Accommodation;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceLabel;

class ReservationType extends AbstractType
{
	private $contactToEmailOrPhoneTransformer;
	private $translator;
	
	public function __construct(ContactToEmailOrPhoneTransformer $contactToEmailOrPhoneTransformer, TranslatorInterface $translator)
	{
		$this->contactToEmailOrPhoneTransformer = $contactToEmailOrPhoneTransformer;
		$this->translator = $translator;
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$roomAmountChoices = [1, 2, 3, 4];
		$peopleAmountChoices = [1, 2, 3, 4];

		$choiceLabelRooms = function($choice, $key, $value){ return "reservation.rooms"; };
		$choiceLabelAmount = function($choice, $key, $value){ return "reservation.amount"; };
		$choiceTranslationParameters = [["amount"=>1], ["amount"=>2], ["amount"=>3], ["amount"=>4], ["amount"=>5]];
		
		$builder->add('checkInAt', DateType::class, ["label" => "reservation.checkin.date?", "widget" => "single_text"]);
		$builder->add('checkOutAt', DateType::class, ["label" => "reservation.stay.until?", "widget" => "single_text"]);
		$builder->add('roomsAmount', ChoiceType::class, ["label" => "reservation.rooms?", "choices" => $roomAmountChoices, "choice_label" => $choiceLabelRooms, "choice_translation_parameters" => $choiceTranslationParameters]);
		$builder->add('peopleAmount', ChoiceType::class, ["label" => "reservation.amount?", "choices" => $peopleAmountChoices, "choice_label" => $choiceLabelAmount, "choice_translation_parameters" => $choiceTranslationParameters]);
		$builder->add("contact", TextType::class, ["label" => "reservation.contact", "mapped" => false]);
		$builder->add('book', SubmitType::class, ["label" => "reservation.booking"]);
		
		$builder->get("contact")->addModelTransformer($this->contactToEmailOrPhoneTransformer);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(['data_class' => Accommodation::class]);
	}
	
	public function finishView(FormView $view, FormInterface $form, array $options)
	{
		foreach ($view->children as $child)
		{
			$child->vars["row_attr"] = ["class" => "reservation-div reservation-div-{$child->vars['name']}"];
			$child->vars["attr"] = ["class" => "reservation-input reservation-input-{$child->vars["name"]}"];
			$child->vars["label_attr"] = ["class" => "reservation-label reservation-label-{$child->vars["name"]}"];
		}
	}
}