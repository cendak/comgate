<?php declare(strict_types = 1);

namespace Contributte\Comgate\Gateway;


use Contributte\Comgate\Entity\PaymentMethodsRequest;
use Contributte\Comgate\Http\HttpClient;
use Contributte\Comgate\Http\Response;

class PaymentMethodsService
{

	/** @var HttpClient */
	protected $client;

	public function __construct(HttpClient $client)
	{
		$this->client = $client;
	}

	public function get(PaymentMethodsRequest $methodsRequest): Response
	{
		$data = $methodsRequest->toArray();
		$data['type'] = 'json';

		return $this->client->get('methods', $data);
	}
}
