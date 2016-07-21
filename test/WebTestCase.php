<?php

namespace test\eLife\Journal;

use eLife\Journal\AppKernel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\Filesystem\Filesystem;

abstract class WebTestCase extends BaseWebTestCase
{
    final protected static function getKernelClass()
    {
        return AppKernel::class;
    }

    final protected static function bootKernel(array $options = [])
    {
        parent::bootKernel($options);

        (new Filesystem())->remove(static::$kernel->getContainer()->getParameter('api_mock'));
    }

    final protected static function mockApiResponse(RequestInterface $request, ResponseInterface $response)
    {
        static::$kernel->getContainer()
            ->get('elife.guzzle.middleware.mock.storage')
            ->save($request, $response);
    }
}