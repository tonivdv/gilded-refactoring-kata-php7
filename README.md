[![Build Status](https://travis-ci.org/tonivdv/gilded-refactoring-kata-php7.svg?branch=feature%2Frefactor-kata)](https://travis-ci.org/tonivdv/gilded-refactoring-kata-php7)

Requirements
------------

The print engine should work out of the box with following requirements:

- MacOS / Linux
- Docker Engine >= 19.03.5
- Docker Compose >= 1.24.1

Once those prerequisites are installed you should be able to execute following command:

`make build`

The above command will build and download all necessary docker images, bootstrap the environment and make it ready
to use the service.

Getting Started
---------------

To begin the kata, install the dependencies and run `phpunit`:

```
make test
```

To exercise the code outside of phpunit, for example to visually confirm that it is working,
use the `texttest_fixture` script:

```
make cli
php fixtures/texttest_fixture.php
```

To start a static analysis of the code run:

```
make analyse-code
```

To enforce code style run:

```
make fix-cs
```