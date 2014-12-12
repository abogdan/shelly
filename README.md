# Shelly

Shelly is a small library that lets you abstract your shell commands using PHP.

### Version
0.1.0

### Installation

You need [Composer] to install the lib:

```json
"require": {
        ...
        "abogdan/shelly": "dev-master",
        ...
    },
```

```sh
composer require abogdan/shelly:dev-master
```

### Examples

```php
use ABogdan\Shelly\Command\CompositeCommand;
use ABogdan\Shelly\Command\SimpleCommand;
use ABogdan\Shelly\Builder;
use ABogdan\Shelly\Executor;
$seq = new \PhpCollection\Sequence();

//simple example
$cat = new SimpleCommand('cat', [__FILE__]);
$executor = new Executor(new Builder());
$output = $executor->execute($cat);

//composite example
$find = new SimpleCommand('find', ['./tests/', '-name', 'Command*'], true);
$cat = new SimpleCommand('cat');
$grep = new SimpleCommand('grep', ['-r', PHP_EOL]);
$seq->add($find);
$seq->add($cat);
$seq->add($grep);
$output = $executor->execute($complex);

```

### Todo's

 - Windows support
 - Better error handling
 - Better binary/executable finder
 - Better building strategy
 - ...

License
----

MIT

[Composer]:https://getcomposer.org/
