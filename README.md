# Netmex Response Bundle

## About

The Netmex Response Bundle is a lightweight Symfony response layer that allows controllers to return simple DTOs instead of manually building `Symfony\Component\HttpFoundation\Response` objects.

The bundle transforms these DTOs into real HTTP responses using **attribute-based metadata and pluggable strategies**.

It helps you:
- Keep controller actions focused (return objects, not Response plumbing).
- Centralise output formatting (JSON, HTML, files, redirects, streams, text, no-content).
- Extend output formats by adding custom strategies.
- Avoid repetitive mapping or manual response building.

## Installation

```bash
composer require netmex/response
```

## Core concept

The system is built around two main ideas:
- DTO (Response Object) → defines the response shape + metadata.
- Strategy → converts payload into a Symfony Response.

## Usage

You return a DTO from your controller. The bundle automatically transforms it into a Response.

### DTO + Attribute (recommended)

This is the main way of using the bundle.

#### Example DTO

```php
<?php

namespace App\Response;

use Netmex\Response\Attribute\Response as ResponseAttr;
use Netmex\Response\Contracts\AbstractResponse;
use Netmex\Response\Strategy\JsonResponseStrategy;

#[ResponseAttr(
    strategy: JsonResponseStrategy::class,
    status: 200,
    collection: true
)]
final class PageCollectionResponse extends AbstractResponse
{
    public string $slug;
    public string $title;
}
```

#### Controller

```php
<?php

namespace App\Controller;

use App\Response\PageCollectionResponse;
use Symfony\Component\Routing\Attribute\Route;

final class PageController
{
    #[Route('/pages', name: 'pages_list')]
    public function index(PagesRepository $repository): PageCollectionResponse
    {
        return new PageCollectionResponse($repository->findAll());
    }
}
```

### How it works

When a controller returns a DTO:

1. The `ResponseListener` intercepts the result.
2. Metadata is extracted from `#[Response]`.
3. A strategy is resolved based on configuration.
4. The DTO payload is passed to the strategy.
5. A Symfony `Response` is returned.

### Built-in strategies

All strategies implement `Netmex\Response\Contracts\ResponseStrategyInterface`.

Available strategies:

- `Netmex\Response\Strategy\JsonResponseStrategy`
- `Netmex\Response\Strategy\HtmlResponseStrategy`
- `Netmex\Response\Strategy\TextResponseStrategy`
- `Netmex\Response\Strategy\NoContentResponseStrategy`
- `Netmex\Response\Strategy\RedirectResponseStrategy`
- `Netmex\Response\Strategy\StreamedResponseStrategy`
- `Netmex\Response\Strategy\BinaryFileResponseStrategy`

### Custom strategy

You can create your own strategy by implementing the interface.

```php
<?php

namespace App\Response\Strategy;

use Netmex\Response\Contracts\ResponseStrategyInterface;
use Symfony\Component\HttpFoundation\Response;

final class MyStrategy implements ResponseStrategyInterface
{
    public function create(mixed $payload, int $status): Response
    {
        return new Response('custom output', $status);
    }
}
```

#### Then register it:

```yaml
services:
  App\Response\Strategy\MyStrategy:
    tags: ['app.response_strategy']
```

### AbstractResponse

The `AbstractResponse` class is used to carry the payload internally and is automatically processed by the bundle. You do not need to manually handle serialization or mapping.

### Exception handling

The bundle throws domain-specific exceptions such as:

- `StrategyNotFoundException`
- `MissingResponseAttributeException`
- `InvalidResponseTypeException`

### Recommended structure

```
src/
├── Controller/
├── Response/
│   └── PageCollectionResponse.php
└── Response/Strategy/
    └── MyStrategy.php
```

## Troubleshooting

### Strategy not found

Ensure:

- The strategy FQCN used in attributes exists.
- The strategy service is registered and tagged (`app.response_strategy`).

### Response not working

- Ensure the `ResponseListener` is enabled.
- Ensure the returned object is either an implementation of `ResponseInterface` or a DTO recognised by the bundle's metadata.

## Contributing

PRs welcome. Follow PSR-12 and add tests for new strategies or behaviour.

## License

MIT
