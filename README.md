# laravel-query

Filter Eloquent queries based on incoming **HTTP request** parameters — clean, extensible, and framework-native.

> **In short:** Build clean, testable Eloquent queries from request parameters like `?status=active&created_from=2025-01-01&sort=-created_at` — without messy if-else logic in your controllers.

---

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Quick Start](#quick-start)
- [Extension Points](#extension-points)
- [License](#license)
- [Credits](#credits)

---

## Features

- 🧩 **Declarative filters** for Parameter Bags from requests, collection, array.
- 🧰 **Extensible operators**: Build your own query builders with the shipped traits
- 🧽 **Clean controllers**: Move query logic out of controllers
- 🔎 **Optional sorting, limiting and skipping** via custom parameters
- 🛳️ **Custom shipping**: use your own transformer logic to get data as you wish (batteries included).
- 📦 **Framework-native**: works directly on Eloquent Model instances


---

## Installation

```bash
composer require mcgo/laravel-query
```

---

## Quick Start

Example: Filtering unfinished `Order` records based on request parameters. You can call the controller with a 
parameter '?unfinished' to get all unfinished orders.

### Build your QueryBuilder:

```php
class OrderQueryBuilder extends \McGo\Query\Contracts\AQueryBuilder
{
    use \McGo\Query\Traits\Builder\HasNullFilter;
    
    // Add filter for unfinished order 
    public function filter(): AQueryBuilder {
        // This adds a query ->whereNull('finished_at') if the request has a parameter 'unfinished'
        $this->addNullFilter('finished_at', 'unfinished');
        return $this;
    }
    
}
```

### Use it in your Controller:
```php
use App\Models\Order;
use App\QueryBuilder\OrderQueryBuilder;
use App\Resources\OrderResourceCollection;
use Illuminate\Http\Request;
use McGo\Query\Query;
use McGo\Query\Transformers\JSONResourceCollectionTransformer;

class OrderIndexController
{
    public function __invoke(Request $request)
    {
        return Query::theModel(Order::class)
            ->withBuilder(OrderQueryBuilder::class)
            ->forRequest($request)
            ->to(new SONResourceCollectionTransformer(OrderResourceCollection::class))
            ->run();
    }
}
```

---

## Extension Points

- Register **custom operators** (`ilike`, `json_contains`, etc.)
- Add **macros** for reusable filter chains
- Define **preset FilterSets** per model or resource

---


## License

[MIT](./LICENSE)

---

## Credits

- Author & Maintainer: [McGo](https://github.com/McGo)
- Purpose: Provide a clean, declarative approach to filtering Eloquent queries based on request parameters.
