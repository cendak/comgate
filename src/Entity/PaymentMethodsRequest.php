<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;


use Contributte\Comgate\Entity\Codes\CountryCode;
use Contributte\Comgate\Entity\Codes\CurrencyCode;
use Contributte\Comgate\Entity\Codes\LangCode;
use Contributte\Comgate\Exceptions\Logical\InvalidArgumentException;

class PaymentMethodsRequest extends AbstractEntity
{
	/** @var ?string ISO 4217 */
	private $curr;

	/** @var ?string */
	private $country;

	/** @var ?string */
	private $lang;

	final private function __construct()
	{
	}

	public static function of(?string $currency = null, ?string $country = null, ?string $lang = null): self
	{
		if ($currency && !in_array($currency, [CurrencyCode::CZK, CurrencyCode::EUR])) {
			throw new InvalidArgumentException('Invalid currency code.');
		}

		if ($country && !in_array($country, [CountryCode::ALL, CountryCode::CZ, CountryCode::SK, CountryCode::PL])) {
			throw new InvalidArgumentException('Invalid country code.');
		}

		if ($lang && !in_array($lang, [LangCode::CS, LangCode::SK, LangCode::EN, LangCode::PL])) {
			throw new InvalidArgumentException('Invalid lang code.');
		}

		$ps = new static();
		$ps->curr = $currency;
		$ps->country = $country;
		$ps->lang = $lang;

		return $ps;
	}

	public function toArray(): array
	{
		return [
			'curr' => $this->curr,
			'country' => $this->country,
			'lang' => $this->lang,
		];
	}

}
