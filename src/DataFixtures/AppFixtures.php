<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Offer;

class AppFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{
		// Create some offers:
		$offer = new Offer();
			$offer->setOfferId(1);
			$offer->setActive(true);
			$offer->setLanguage("pl");
			$offer->setSlug("sloneczna-zima");
			$offer->setTitle("Słoneczna Zima");
			$offer->setDescription("Nią lewo woń życiu wujem staropolskim. Imion  nowo. Jarmarkach źrenice już wolności zacność przepraszać pokoju. Pozostało najwymowniejsza pocałowania.");
			$manager->persist($offer);
			
		$offer = new Offer();
			$offer->setOfferId(1);
			$offer->setActive(true);
			$offer->setLanguage("en");
			$offer->setSlug("sunny-winter");
			$offer->setTitle("Sunny Winter");
			$offer->setDescription("Entire extremity grave what. Civility wooded ten whole. Sister expression material warrant green denoting secure elinor decay ye perfectly walls if.");
			$manager->persist($offer);
		
		$offer = new Offer();
			$offer->setOfferId(1);
			$offer->setActive(true);
			$offer->setLanguage("es");
			$offer->setSlug("invierno-soleado");
			$offer->setTitle("Invierno Soleado");
			$offer->setDescription("Lechuguino rito oro resignada menudeaban acabar familia crimen testigos aunque aseguraban justos.  Va doncellas perdido ellas aqui rara ser fiscalizar devolvere ordinarios amor comuna injustas creia.");
			$manager->persist($offer);
		
		$offer = new Offer();
			$offer->setOfferId(2);
			$offer->setActive(true);
			$offer->setLanguage("pl");
			$offer->setSlug("mrozna-wiosna");
			$offer->setTitle("Mroźna wiosna");
			$offer->setDescription("uskie zgromadzenie Czarnoziemne bliski rzeczy Złoty dzieciństwa przedmiotach uśmiéchał dalsze oręż ludzie. Wieśniakami damami garnuszeczek tając Męszczyźni padał zrobim damach ciotka. Nalewa Woźnemu skradał siadł zechcesz wielka świeżo wąchał cyfrę ciężar.");
			$manager->persist($offer);
		
		$offer = new Offer();
			$offer->setOfferId(2);
			$offer->setActive(true);
			$offer->setLanguage("en");
			$offer->setSlug("frosty-spring");
			$offer->setTitle("Frosty spring");
			$offer->setDescription("Unwilling departure education is be dashwoods or an. Use off agreeable law unwilling sir deficient curiosity instantly. Easy mind life fact with see has bore ten. Parish any chatty can elinor direct for former. Up as meant widow equal an share least.");
			$manager->persist($offer);
			
		$offer = new Offer();
			$offer->setOfferId(2);
			$offer->setActive(true);
			$offer->setLanguage("es");
			$offer->setSlug("primavera-helada");
			$offer->setTitle("Primavera helada ");
			$offer->setDescription("La grandezas favoritas se funciones gentileza al la economico. Opto oh dijo ni algo. Dio ofrecido eso buscarlo vendaval. Mis mia carnes suaves siglos emitir tienda ahinco.");
			$manager->persist($offer);
			
		$manager->flush();
	}
}
