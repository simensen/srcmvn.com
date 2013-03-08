---
layout: post
title: Silex Service Providers and Controller Providers; What Is Safe To Do Where?
date: 2013-03-08 10:00
tags:
    - silex

---

Since discussing [writing Silex service providers][1] a few edge cases have
come up that I'd like to touch on. I've also learned more about controller
providers and how they fit into the big picture. Here are a few more rules and
guidelines to help make writing Silex service providers and controller providers
a little easier.


## Service Provider Registering Another Service Provider

One may be tempted to register another service provider from a service
provider's `register` method. Take the following example:

    use Silex\Application;
    use Silex\Provider\DoctrineServiceProvider;
    use Silex\ServiceProviderInterface;
    
    public function MyServiceProvider implements ServiceProviderInterface
    {
        public function boot(Application $app)
        {
        }
        
        public function register(Application $app)
        {
            // This is probably not wise.
            $app->register(new DoctrineServiceProvider);
        }
    }

While there is nothing wrong with this from an interface perspective, it
violates the *spirit* of the service provider contract.

One of the rules from [Writing Silex Service Providers][1] was to treat the
`Application` type hint for `register` as if it were actually `Pimple`.
`Pimple` does not have a `register` method so by this rule `register` should
not be called from within `register`.

What about the fact that Pimple itself may some day support a `register` method
of its own? Well, when that happens we can revisit the issue. :) Until then the
existing rule holds.

But doesn't registering a service provider pretty much just defines more services?
Yes, this is true. However, doing so hides the fact that the service provider is
being registered from the user. This is not good.

Consider the example above where we are registering the Doctrine service provider.
What happens if the user doesn't realize this and they register the Doctrine
provider themselves? In some cases this may be mostly harmless but in others this
could be very bad.

By registering another service provider directly we end up with two problems. First,
we are hiding dependencies. Second, we are tying our service provider to a specific
implementation.

### Hidden Dependencies

Take a slightly extended example where Doctrine service provider is registered
by a service provider:

    use Silex\Application;
    use Silex\Provider\DoctrineServiceProvider;
    use Silex\ServiceProviderInterface;
    
    public function MyServiceProvider implements ServiceProviderInterface
    {
        public function boot(Application $app)
        {
        }
        
        public function register(Application $app)
        {
            // This is probably not wise.
            $app->register(new DoctrineServiceProvider);
            
            $app['myapp.someservice'] = $app->share(function () use ($app) {
                // do something with $app['db'];
            });
        }
    }

Written this way our service provider has a hidden dependency on the Doctrine
service provider.

Rather than register the Doctrine service provider directly we should document
that the user needs to register it themselves. This allows them to register it
and configure it however they see fit.

To quote [Igor][3] on why this is the best approach:

> ... it means you don't get to configure that provider when it is registered<br>
> it's about giving the user control and dependency inversion ...

### Tied to a Specific Implementation

To take it a step further, we can document *exactly what we need*, namely that
we need `$app['db']` to be available and that it needs to be an instance of
Doctrine DBAL Connection.

To help the user out we can say that this service can be provided by the Doctrine
service provider and even use it in example code.

An example of this in action would be the [requirements][4] of the [Doctrine ORM
Service Provider][5]:

> Currently requires both **dbs** and **dbs.event_manager** services in order to
> work. These can be provided by a Doctrine Service Provider like the Silex or
> Cilex service providers. If you can or want to fake it, go for it. :)

As is usually the case, by not tying our service provider to another service
provider directly we will also get the added benefit of increased testability
for our service provider.


## Responsibility of Controller Provider's connect() Method

The responsibility of a Controller Provider's `connect` method is to wire up
controllers. That is it. The rule is simple. This means that services should
not be defined in a controller provider.


## A Single Class Can Provide Both Services and Controllers

When discussing controller services and splitting the service definitions from the
routing, [Igor][3] reminded me of a simple truth about interfaces. Classes can
implement more than one interface at a time.

This means that a class can implement both the service provider interface and the
controller provider interface at the same time. This is a nice solution for building
out a provider for controllers as services:

    class MyAppControllersProvider implements
        ServiceProviderInterface,
        ControllerProviderInterface
    {
        function boot(Application $app)
        {
        }

        function register(Application $app)
        {
            //
            // Define controller services
            //

            $app['myapp.hellocontroller'] = $app->share(function() use ($app) {
                return new MyApp\Controller\HelloController($app['some.service']);
            });
        }

        public function connect(Application $app)
        {
            $controllers = $app['controllers_factory'];

            //
            // Define routing referring to controller services
            //

            $controllers->get('/hello/{name}', 'myapp.hellocontroller:say')
                ->method('GET')
                ->bind('myapp.hello');

            return $controllers;
        }
    }


This allows us to follow the rules of only defining services in `register`
and only defining controllers in `connect` but keeping the code in the same
class. Win!

---

One caveat to this is that we have to register and mount the provider
separately. For example:

    $myAppControllersProvider = new MyAppControllersProvider;
    
    $app->register($myAppControllersProvider);
    $app->mount('/', $myAppControllersProvider);


## Mounting Controller Provider in boot()

It might seem logical to mount a controller provider in `boot`.
While not strictly wrong since `Application` code is more or less
safe to call from inside `boot` it is probably not the best choice.

Mounting a controller provider inside `boot` will take away some control
of the controller provider from the user. For example, the user will
lose the ability to mount the controller provider at a path of their
choice.

So while one *can* do it, it would be best to do so sparingly. More often
than not the right decision is probably to allow the user to mount
the controller provider themselves.


## Control

A common theme seen here is control. The question of mounting a controller
in `boot` is similar to question of registering a service provider from
within a service provider. Both are attempts to wrangle control from the
user.

This control is important. We should do what we can to not limit it if we do
not need to.


## Join Us

Seriously, people, [#silex-php][2] rocks. Come join us if you want to discuss
awesome things and learn Silex best practices. :)


[1]: http://srcmvn.com/blog/2013/02/22/writing-silex-service-providers/
[2]: irc://irc.freenode.net/silex-php
[3]: https://igor.io
[4]: https://github.com/dflydev/dflydev-doctrine-orm-service-provider#requirements
[5]: https://github.com/dflydev/dflydev-doctrine-orm-service-provider