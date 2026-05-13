<?php

/**
 * This file is part of the ReCaptchaControl package
 *
 * @license  MIT
 * @author   Petr Kessler (https://kesspess.cz)
 * @link     https://github.com/uestla/ReCaptchaControl
 */

declare(strict_types = 1);

namespace ReCaptchaControl\Http\Requester;

use GuzzleHttp\ClientInterface;


class GuzzleRequester implements IRequester
{

	/** @var ClientInterface */
	private $client;


	public function __construct(ClientInterface $client)
	{
		$this->client = $client;
	}


 public function post(string $url, array $values = [], bool $asJson = false): string
 {
     try {
         $options = [];
         if ($asJson) {
             $options['json'] = $values;
         } else {
             $options['form_params'] = $values;
         }

         $response = $this->client->request('POST', $url, $options);

         return (string) $response->getBody();

     } catch (\Exception $e) {}

     throw RequestException::create($url, $e->getMessage());
 }

}
