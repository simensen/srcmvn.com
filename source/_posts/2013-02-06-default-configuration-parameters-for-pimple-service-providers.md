---
layout: post
title: Default Configuration Parameters for Pimple Service Providers
date: 2013-02-06 09:36
tags:
    - php
    - pimple
    - silex

---

A common requirement when writing service providers for [Pimple][1] based
projects is to provide default values for some or all of the configuration
parameters. Unfortunately, this is not as straightforward as it sounds.

---

<em>**Update**: And [just like that](https://github.com/silexphp/Silex/pull/622),
the whole premise of this blog post became moot. [Thanks Igor!](https://igor.io)
On one hand it is nice to have changed the world; on the other hand, it would
have been nice to not have spent time writing this post. :P I would argue this
is still a nice defensive strategy to guard against people going against the
official recommendation and continue to set parameter values before registering
a service, but I believe you can now officially tell someone to shove off and/or
RTFM if they complain that your default parameters clobber their settings.</em>

---

Since we cannot guarantee how Pimple is being configured or the order in
which our service provider is loaded strange things can happen if we try
to set default values in our service provider's `register` method.

This sample [Silex][2] service provider illustrates the problem:

    use Silex\Application;
    use Silex\ServiceProviderInterface;

    class ExampleServiceProvider implements ServiceProviderInterface
    {
        public function register(Application $app)
        {
            // Default configuration is for 'hello' to be 'world'.
            $app['example.hello'] = 'world';
        }

        public function boot(Application $app)
        {
        }
    }

    $app = new Application;
    $app['example.hello'] = 'earth';
    $app->register(new ExampleServiceProvider);

    // INCORRECT
    echo var_dump($app['example.hello']); // string(5) "world"

    $app = new Application;
    $app->register(new ExampleServiceProvider, array('example.hello' => 'earth'));

    // CORRECT
    echo var_dump($app['example.hello']); // string(5) "earth"

    $app = new Application;
    $app->register(new ExampleServiceProvider);
    $app['example.hello'] = 'earth';

    // CORRECT
    echo var_dump($app['example.hello']); // string(5) "earth"


See what happened there? In the first case the parameter is set before the service
provider is registered. The end result is that the service provider wrote the default
value over the value previously set by the user. This is likely **not** going to be
what the user expects.

This means we cannot blindly set any parameters in `register`. We must take care
to only set a parameter to its default value if it has not already been set.

I borrowed the following solution from the [Doctrine Service Provider][3] while
writing the [Doctrine ORM Service Provider][4] and it works pretty nicely:

    use Silex\Application;
    use Silex\ServiceProviderInterface;

    class ExampleServiceProvider implements ServiceProviderInterface
    {
        public function register(Application $app)
        {
            foreach ($this->getDefaultParameters() as $name => $value) {
                if (!isset($app[$name])) {
                    $app[$name] = $value;
                }
            }
        }

        public function boot(Application $app)
        {
        }

        protected function getDefaultParameters()
        {
            return array(
                // Default configuration is for 'hello' to be 'world'.
                'example.hello' => 'world',
            );
        }
    }

    $app = new Application;
    $app['example.hello'] = 'earth';
    $app->register(new ExampleServiceProvider);

    // CORRECT
    echo var_dump($app['example.hello']); // string(5) "earth"

    $app = new Application;
    $app->register(new ExampleServiceProvider, array('example.hello' => 'earth'));

    // CORRECT
    echo var_dump($app['example.hello']); // string(5) "earth"

    $app = new Application;
    $app->register(new ExampleServiceProvider);
    $app['example.hello'] = 'earth';

    // CORRECT
    echo var_dump($app['example.hello']); // string(5) "earth"


Now we get the same expected value in all cases. Huzzah!


[1]: http://pimple.sensiolabs.org/
[2]: http://silex.sensiolabs.org/
[3]: http://silex.sensiolabs.org/doc/providers/doctrine.html
[4]: https://github.com/dflydev/dflydev-doctrine-orm-service-provider
