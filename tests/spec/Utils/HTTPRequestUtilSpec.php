<?php

namespace spec\App\Utils;

use PhpSpec\Laravel\LaravelObjectBehavior;
use App\Utils\HTTPRequestUtil;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class HTTPRequestUtilSpec extends LaravelObjectBehavior
{
    public function let(ClientInterface $httpClient)
    {
        $this->beAnInstanceOf(\App\Utils\HTTPRequestUtil::class, [$httpClient]);
    }

    /************ get ***************/
    public function it_get_should_success(
        ClientInterface $httpClient 
    ) {
        $url = 'http://test.com';
        $querys = [
            'a' => 'aa',
            'b' => 'bb',
        ];
        $options = [
            RequestOptions::QUERY => $querys,
        ];
        $response = new Response(
            200, [], 'OK'
        );
        $httpClient->request('GET', $url, $options)
            ->shouldBeCalledTimes(1)
            ->willReturn($response);

        $this->get($url, $querys)->shouldBe('OK');
    }

    public function it_get_throw_exception_cause_bad_response(
        ClientInterface $httpClient 
    ) {
        $url = 'http://test.com';
        $querys = [
            'a' => 'aa',
            'b' => 'bb',
        ];
        $options = [
            RequestOptions::QUERY => $querys,
        ];
        $response = new Response(
            500, [], 'system error'
        );
        $httpClient->request('GET', $url, $options)
            ->shouldBeCalledTimes(1)
            ->willReturn($response);

        $this->shouldThrow(\App\Exceptions\HTTPRequest\BadResponseException::class)
            ->duringGet($url, $querys);
    }

    /************ post **************/
    public function it_post_should_success(
        ClientInterface $httpClient 
    ) {
        $url = 'http://test.com';
        $formData = [
            'a' => 'aa',
            'b' => 'bb',
        ];
        $options = [
            RequestOptions::FORM_PARAMS => $formData,
        ];
        $response = new Response(
            200, [], 'OK'
        );
        $httpClient->request('POST', $url, $options)
            ->shouldBeCalledTimes(1)
            ->willReturn($response);

        $this->post($url, $formData)->shouldBe('OK');
    }
}
