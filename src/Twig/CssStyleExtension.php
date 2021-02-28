<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CssStyleExtension extends AbstractExtension
{
    public function getFilters(): array
    {
		return 
		[
			new TwigFilter("style", [$this, 'getCssStyle'], ["is_safe" => ["html"]]),
			new TwigFilter("*Attr", [$this, 'getHtmlAttr'], ["is_safe" => ["html"]]),
      ];
    }

	public function getFunctions(): array
	{
		return 
		[
			new TwigFunction("reIndexTo", [$this, "reIndexTo"])
		];
	}
	
	public function getCssStyle($argument)
	{
		$style = "";
		for($i = 0, $j = 1; $j < count($argument) ; $i+=2,$j+=2) $style.= "$argument[$i]:$argument[$j];";
		return "style=\"$style\"";
	}
	
	public function getHtmlAttr($prefix, $argument)
	{
		$name = strtolower(preg_replace("/[A-Z]/", "-$0", $prefix)); // prepend uppercase letters with "-"
		return "data-${name}=\"${argument}\"";
	}
	
	public function reIndexTo(array $argument, string $index, string $value = null)
	{
		$reIndex = [];
		for($i=0; $i < count($argument); $i++) $reIndex[$argument[$i]->$index()] = ($value == null) ? $i : $argument[$i]->$value();
		return $reIndex;
	}
}
