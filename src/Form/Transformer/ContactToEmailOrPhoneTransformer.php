<?php
namespace App\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Guest;

class ContactToEmailOrPhoneTransformer implements DataTransformerInterface
{
	private $em;
	
	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->em = $entityManager;
	}
	
	/**
	 * Transform Guest to contact string.
	 * 
	 */
	public function transform($guest): string
	{
		if($guest === null) return "";
		
		return $guest->getEmail();
	}
	
	/**
	 * Transform contact string to Guest object.
	 */ 
	public function reverseTransform($contact) : ?Guest
	{
		$guest = $this->em->getRepository(Guest::class)->loadUserByUsername($contact);
		
		if($guest == null)
		{
			$isEmail = strpos($contact, "@") !== false;
			$guest = new Guest();
			switch($isEmail)
			{
				case true: $guest->setEmail($contact); break;
				case false: $guest->setPhone($contact); break;
			}
			$this->em->persist($guest);
		}
		
		return $guest;
	}
}