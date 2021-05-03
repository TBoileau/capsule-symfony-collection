<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class FooTest extends WebTestCase
{
    public function testList(): void
    {
        $client = static::createClient();

        $client->request("GET", "/");

        $this->assertResponseIsSuccessful();
    }

    public function testCreate(): void
    {
        $client = static::createClient();

        $crawler = $client->request("GET", "/create");

        $this->assertResponseIsSuccessful();

        $client->request("POST", "/create", [
            'foo' => [
                '_token' => $crawler
                    ->filter("form[name=foo]")
                    ->form()
                    ->get("foo")["_token"]
                    ->getValue(),
                'name' => 'Foo name',
                'bars' => [
                    ['name' => 'Bar 1'],
                    ['name' => 'Bar 2']
                ],
                'bazs' => [
                    ['name' => 'Baz 1'],
                    ['name' => 'Baz 2']
                ],
                'quxes' => [
                    ['name' => 'Qux 1'],
                    ['name' => 'Qux 2']
                ]
            ]
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testUpdate(): void
    {
        $client = static::createClient();

        $crawler = $client->request("GET", "/1/update");

        $this->assertResponseIsSuccessful();

        $client->request("POST", "/1/update", [
            'foo' => [
                '_token' => $crawler
                    ->filter("form[name=foo]")
                    ->form()
                    ->get("foo")["_token"]
                    ->getValue(),
                'name' => 'Foo name',
                'bars' => [
                    ['name' => 'Bar 1']
                ],
                'bazs' => [
                    ['name' => 'Baz 1']
                ],
                'quxes' => [
                    ['name' => 'Qux 1']
                ]
            ]
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    /**
     * @dataProvider provideFailedData
     */
    public function testCreateFailed(array $formData, string $errorMessage): void
    {
        $client = static::createClient();

        $crawler = $client->request("GET", "/create");

        $this->assertResponseIsSuccessful();

        $client->request("POST", "/create", [
            'foo' => $formData + [
                '_token' => $crawler
                    ->filter("form[name=foo]")
                    ->form()
                    ->get("foo")["_token"]
                    ->getValue()
            ]
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains(".form-error-message", $errorMessage);
    }

    public function provideFailedData(): \Generator
    {
        yield [
            [
                'name' => '',
                'bars' => [
                    ['name' => 'Bar 1']
                ],
                'bazs' => [
                    ['name' => 'Baz 1']
                ],
                'quxes' => [
                    ['name' => 'Qux 1']
                ]
            ],
            "Cette valeur ne doit pas être vide."
        ];

        yield [
            [
                'name' => 'Foo name',
                'bars' => [
                    ['name' => '']
                ],
                'bazs' => [
                    ['name' => 'Baz 1']
                ],
                'quxes' => [
                    ['name' => 'Qux 1']
                ]
            ],
            "Cette valeur ne doit pas être vide."
        ];

        yield [
            [
                'name' => 'Foo name',
                'bars' => [
                    ['name' => 'Bar 1']
                ],
                'bazs' => [
                    ['name' => '']
                ],
                'quxes' => [
                    ['name' => 'Qux 1']
                ]
            ],
            "Cette valeur ne doit pas être vide."
        ];

        yield [
            [
                'name' => 'Foo name',
                'bars' => [
                    ['name' => 'Bar 1']
                ],
                'bazs' => [
                    ['name' => 'Baz 1']
                ],
                'quxes' => [
                    ['name' => '']
                ]
            ],
            "Cette valeur ne doit pas être vide."
        ];

        yield [
            [
                'name' => 'Foo name',
                'bars' => [],
                'bazs' => [
                    ['name' => 'Baz 1']
                ],
                'quxes' => [
                    ['name' => 'Qux 1']
                ]
            ],
            "Cette collection doit contenir 1 élément ou plus."
        ];

        yield [
            [
                'name' => 'Foo name',
                'bars' => [
                    ['name' => 'Bar 1']
                ],
                'bazs' => [],
                'quxes' => [
                    ['name' => 'Qux 1']
                ]
            ],
            "Cette collection doit contenir 1 élément ou plus."
        ];

        yield [
            [
                'name' => 'Foo name',
                'bars' => [
                    ['name' => 'Bar 1']
                ],
                'bazs' => [
                    ['name' => 'Baz 1']
                ],
                'quxes' => []
            ],
            "Cette collection doit contenir 1 élément ou plus."
        ];
    }
}
