# Netmex Response Bundle

This Symfony bundle allows you to handle API responses using custom response classes. It provides a `ResponseInterface` to standardize how your application manages its responses, making it easy to handle and customize API output and error handling.


## Installation

```composer require netmex/response```

## Usage

Implement the ```Netmex\Response\ResponseInterface``` in your custom response class.

When you implement the ResponseInterface, you need to define the two methods toResponse and onError.

```toResponse(Request $request): Response```
This method is responsible for converting your data into a valid Symfony ```Response``` object (e.g., ```JsonResponse``` or any other type based on your needs). It is used for handling successful API responses.

```onError(HttpException $error): Response```
This method is called when an error occurs (for example, when an exception is thrown). It allows you to handle error responses and return custom error messages or formats.

##### Example Response Class

```
<?php

namespace App\Response;

use Netmex\Response\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MyCustomResponse implements ResponseInterface
{
    public function __construct(private array $data) {}

    public function toResponse(Request $request): JsonResponse
    {
        return new JsonResponse($this->data);
    }

    public function onError(HttpException $e): JsonResponse
    {
        return new JsonResponse([
            'error' => $e->getMessage(),
        ], 500);
    }
}
```


##### Controller

In your controller, simply return your custom response:

```
<?php

namespace App\Controller;

use App\Response\CustomResponse;
use Symfony\Component\Routing\Annotation\Route;

class ExampleController
{
    #[Route('/example', name: 'app_example')]
    public function index(): CustomResponse
    {
        $data = ['foo' => 'bar'];
        return new CustomResponse($data);
    }
}

```

## Recommended Directory Layout
```
src/
├── Controller/
├── Response/         <-- Define your responses here

```