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
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use App\Form\Transformer\ContactToEmailOrPhoneTransformer;
use App\Entity\Accommodation;

class ReservationType extends AbstractType
{
	private $contactToEmailOrPhoneTransformer;
	
	public function __construct(ContactToEmailOrPhoneTransformer $contactToEmailOrPhoneTransformer)
	{
		$this->contactToEmailOrPhoneTransformer = $contactToEmailOrPhoneTransformer;
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(['data_class' => Accommodation::class]);
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$roomAmountChoices = Accommodation::getRoomsAmountOptions();
		$peopleAmountChoices = Accommodation::getPeopleAmountOptions();
		$choiceLabelRooms = function($choice, $key, $value){ return "reservation.rooms"; };
		$choiceLabelAmount = function($choice, $key, $value){ return "reservation.amount"; };
		$choiceTranslationParameters = [["amount"=>1], ["amount"=>2], ["amount"=>3], ["amount"=>4], ["amount"=>5]];
		
		$builder->add('checkInAt', DateType::class, ["label" => "reservation.checkin.date?", "invalid_message" => "reservation.checkindate.is.invalid", "widget" => "single_text"]);
		$builder->add('checkOutAt', DateType::class, ["label" => "reservation.stay.until?", "invalid_message" => "reservation.checkoutdate.is.invalid", "widget" => "single_text"]);
		$builder->add('roomsAmount', ChoiceType::class, ["label" => "reservation.rooms?", "invalid_message" => "reservation.roomsAmount.is.invalid", "choices" => $roomAmountChoices, "choice_label" => $choiceLabelRooms, "choice_translation_parameters" => $choiceTranslationParameters]);
		$builder->add('peopleAmount', ChoiceType::class, ["label" => "reservation.amount?", "invalid_message" => "reservation.peopleAmount.is.invalid", "choices" => $peopleAmountChoices, "choice_label" => $choiceLabelAmount, "choice_translation_parameters" => $choiceTranslationParameters]);
		$builder->add("contact", TextType::class, ["label" => "reservation.contact", "invalid_message" => "reservation.contact.is.invalid", "mapped" => false]);
		$builder->add('book', SubmitType::class, ["label" => "reservation.booking"]);
		$builder->get("contact")->addModelTransformer($this->contactToEmailOrPhoneTransformer);
	}
}
