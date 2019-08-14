### PHP-ENUM
There is not any `ENUM` in php programming language. BTW every programmer may need to this feature.

In this library i provide the simple and easy way for working with enums.

##### Installation
Run bellow command:
```bash
composer require morilog/php-enum
```

#### Usage
##### Writing new Enums
Create a class that extends the `\Morilog\PhpEnum\Enum` class

> Constants keys must be all UPPER_CASE and separate words by `_` (underscore)

> Constants values can be all scalar values such as `string`, `integer`, `boolean`, etc.
```php
<?php

use Morilog\PhpEnum\Enum;

final class CommentStatus extends Enum
{
    const APPROVED = 1;
    const REJECTED = 2;
    const SOMETHING_ELSE = 3;
}

``` 

##### Creating enum instances
##### By class constructor
```php
<?php

$status = new CommentStatus(1);
$status->key(); // APPROVED
$status->value(); // 1
$status->isApproved(); // true
$status->isRejected(); // false
```

##### By `camelCase` constant name 
```php
<?php

$status = CommentStatus::rejected();
$status->key(); // REJECTED
$status->value(); // 2
$status->isApproved(); // false
$status->isRejected(); // true

$other = CommentStatus::somethingElse();
$other->key(); // SOMETHING_ELSE
$other->value(); // 3
$other->isApproved(); // false
$other->isRejected(); // false
$other->isSomethingElse(); // true
```

##### By `fromKey()` method
```php
<?php

$status = CommentStatus::fromKey('APPROVED');
```

#### By `fromValue()` method
```php
<?php

$status = CommentStatus::fromValue(1);
```

#### Static methods
```php
<?php

CommentStatus::keys(); // [APPROVED, REJECTED, SOMETHING_ELSE]

CommentStatus::values(); // [1, 2, 3]

CommentStatus::toArray(); // [APPROVED => 1, REJECTED => 2, SOMETHING_ELSE => 3]
```


#### Comparison enums
```php
<?php

$first = CommentStatus::approved();
$second = CommentStatus::rejected();
$third = CommentStatus::approved();

$first->equalsTo($second); // false
$first->equalsTo($third); // true
```
