<?php

namespace App\Form;

use App\Entity\Accommodation;
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


class ReservationType extends AbstractType
{
	private $translator;
	
	public function __construct(TranslatorInterface $translator)
	{
		$this->translator = $translator;
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		// TODO process for translating options should be done in Twig templates. 
		// Take a look on: https://github.com/symfony/form/commit/8cc1f8eb1221aedc8e6c2df555379c3bf0acd6bf
		$roomAmountChoices = $this->getRoomAmountChoices();
		$peopleAmountChoices = $this->getPeopleAmountChoices();
		
		$builder->add('checkInAt', DateType::class, ["label" => "reservation.checkin.date?", "widget" => "single_text"]);
		$builder->add('checkOutAt', DateType::class, ["label" => "reservation.stay.until?", "widget" => "single_text"]);
		$builder->add('roomsAmount', ChoiceType::class, ["label" => "reservation.amount?", "choices" => $roomAmountChoices]);
		$builder->add('peopleAmount', ChoiceType::class, ["label" => "reservation.rooms?", "choices" => $peopleAmountChoices]);
		$builder->add("contact", TextType::class, ["label" => "reservation.contact", "mapped" => false]);
		$builder->add('book', SubmitType::class, ["label" => "reservation.booking"]);
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
	
	private function getRoomAmountChoices()
	{
		return 
		[
			$this->translator->trans("reservation.rooms", ["rooms" => 1]) => 1,
			$this->translator->trans("reservation.rooms", ["rooms" => 2]) => 2,
			$this->translator->trans("reservation.rooms", ["rooms" => 3]) => 3,
			$this->translator->trans("reservation.rooms", ["rooms" => 4]) => 4,
		];
	}
	
	private function getPeopleAmountChoices()
	{
		return 
		[
			$this->translator->trans("reservation.amount", ["persons" => 1]) => 1,
			$this->translator->trans("reservation.amount", ["persons" => 2]) => 2,
			$this->translator->trans("reservation.amount", ["persons" => 3]) => 3,
			$this->translator->trans("reservation.amount", ["persons" => 4]) => 4,
		];
	}
	
}
