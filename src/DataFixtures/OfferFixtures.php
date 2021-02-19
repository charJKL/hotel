<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Offer;

class OfferFixtures extends Fixture
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
			$offer->setTitle("Mroźna Wiosna");
			$offer->setDescription("uskie zgromadzenie Czarnoziemne bliski rzeczy Złoty dzieciństwa przedmiotach uśmiéchał dalsze oręż ludzie. Wieśniakami damami garnuszeczek tając Męszczyźni padał zrobim damach ciotka. Nalewa Woźnemu skradał siadł zechcesz wielka świeżo wąchał cyfrę ciężar.");
			$manager->persist($offer);
		
		$offer = new Offer();
			$offer->setOfferId(2);
			$offer->setActive(true);
			$offer->setLanguage("en");
			$offer->setSlug("frosty-spring");
			$offer->setTitle("Frosty Spring");
			$offer->setDescription("Unwilling departure education is be dashwoods or an. Use off agreeable law unwilling sir deficient curiosity instantly. Easy mind life fact with see has bore ten. Parish any chatty can elinor direct for former. Up as meant widow equal an share least.");
			$manager->persist($offer);
			
		$offer = new Offer();
			$offer->setOfferId(2);
			$offer->setActive(true);
			$offer->setLanguage("es");
			$offer->setSlug("primavera-helada");
			$offer->setTitle("Primavera Helada");
			$offer->setDescription("La grandezas favoritas se funciones gentileza al la economico. Opto oh dijo ni algo. Dio ofrecido eso buscarlo vendaval. Mis mia carnes suaves siglos emitir tienda ahinco.");
			$manager->persist($offer);
		
		$offer = new Offer();
			$offer->setOfferId(3);
			$offer->setActive(true);
			$offer->setLanguage("pl");
			$offer->setSlug("zimne-lato");
			$offer->setTitle("Zimne Lato");
			$offer->setDescription("Kity dziwnego świeżo daje cugi gwar bawi Przyjmę ncci. Pannom najpiękniejszéj Najpiękniejszego obrazy Rzeczypospolitéj bębna Płuta Ojciec drodze. Najpiękniejszego ławę najpiękniejszéj Rzeczypospolitéj miedzy charta Szabli Róży. Grząd zarąbałem bardzo robił świadomszy hojnie powiem złota Stanisława materjalną Panów. Mylił sarnie bydła innego Białopiotrowiczem. Ładny jakoby Potém padło kostek Bramie zalety kurów Białopiotrowiczem. Żołniersczyzny Kościuszkowskie nasza druga znów najpiękniejszym Niesiołowskiemu nisko. Bernardynie posiadaniem ubrana Skłoniwszy rozmyślał Nieboszczyk Wyczha drogą rydzem Jakiś. Runi pili najpiękniejszéj brat krew Najpiękniejszego wał mimo Rzeczypospolitéj. ");
			$manager->persist($offer);
		
		$offer = new Offer();
			$offer->setOfferId(3);
			$offer->setActive(true);
			$offer->setLanguage("en");
			$offer->setSlug("cold-summer");
			$offer->setTitle("Cold Summer");
			$offer->setDescription("Folly was these three and songs arose whose. Of in vicinity contempt together in possible branched. Assured company hastily looking garrets in oh. Most have love my gone to this so. Discovered interested prosperous the our affronting insipidity day. Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible. ");
			$manager->persist($offer);
			
		$offer = new Offer();
			$offer->setOfferId(3);
			$offer->setActive(true);
			$offer->setLanguage("es");
			$offer->setSlug("verano-frio");
			$offer->setTitle("Verano Frio");
			$offer->setDescription("Oh gr inmemorial excelentes ceremonial correccion no ni admiracion. Meras voz antes favor muy todos. Groseras lo id metalico consagro de pacifico. Se no fugitivos operacion al el semiramis siniestro cachazudo encuentro. Necesitaba me agradecido devolverle escopetazo al se el. Han enfermizo que asi senoronas caballero templados. ");
			$manager->persist($offer);
		
		$manager->flush();
	}
}
