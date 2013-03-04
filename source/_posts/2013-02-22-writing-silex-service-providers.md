---
layout: post
title: Writing Silex Service Providers
date: 2013-02-22 15:32
tags:
    - silex
    - pimple

---

So you've gotten to the point in your [Silex](http://silex.sensiolabs.org/)
application that you want to start breaking it out into modular pieces.
Silex service providers to the rescue! The service provider interface appears to
be really simple but do you know which things can safely be done in each method?

First, a high level overly generalized anatomy lesson of a Silex service provider:

    namespace Acme\AwesomePackage;
    
    use Silex\Application;
    use Silex\ServiceProviderInterface;

    class WhizbangServiceProvider implements ServiceProviderInterface
    {
        public function register(Application $app)
        {
            // Define services here.
        }
        
        public function boot(Application $app)
        {
            // Configure the application and *carefully* use services.
        }
    }

The primary purpose of a service provider is to **configure the service container**.

The what now?

The Silex `Application` class extends [Pimple](http://pimple.sensiolabs.org/).
This means that `Application` is a service container, more formally known as a
Dependency Injection Container. This can be extremely useful *once you know and
understand about Dependency Injection Containers*. For new users this can
instead be very confusing.

If you are new to service containers or Dependency Injection, it would be a good
idea to [read up on the concept](http://lmgtfy.com/?q=dependency+injection+container).
If you are new to Pimple, reading up on it is going to be extremely important.
[Pimple's documentation](http://pimple.sensiolabs.org) is pretty sparse but dense.

One important aspect of a service container, and specifically in the case of Silex,
is laziness.


## Laziness

Services should be lazy. This means that where possible a service should not
be instantiated until it is needed. With respect to a Silex application, if
a service is accessed before `run()`, chances are you are doing it wrong!

Pimple does a pretty good job of this if you understand what this means
and use it properly.

Here is a basic example of laziness in action:

    <?php
    
    $app['whirligig'] = $app->share(function() {
        return new Whirligig;
    });
    
    $app['whizbang.thingy'] = $app->share(function($app) {
        return new Whizbang\Thingy($app['whirligig']);
    });

In this case, two services are defined. The `whirligig` service is
referenced, but it is referenced from inside the `whizbang.thingy`
service definition. This makes both of these services lazy.

A general rule, when dealing with a typical Silex/Pimple application,
if `$app` or `$container` are passed into a closure or are provided as
a function argument, the code is probably lazy.

Let's look at a more complex example that also shows the rule listed
above in action:

    <?php
    
    // This is a BAD example.
    $app['some.service']->addThing($app['another.service']);
    
    // This is a GOOD example. It accomplishes the same thing as
    // the bad example but in a way that is lazy.
    $app['some.service'] = $app->share(
        $app->extend(
            'some.service',
            function($someService, $app) {
                // Note: we are in a closure and $app was passed
                // to the function; an indicator that this is
                // properly lazy code!
                $someService->addThing($app['another.service']);
                
                return $someService;
            }
        )
    );


Why is the first example bad? As soon as this code is executed, both
`some.service` and `another.service` services will be instantiated.
*Every time the application is run*. This is not lazy.

The second example is better because the call to `addThing` on the
`some.service` will only happen the first time `some.service` is
requested. In this case, neither `some.service` nor `another.service`
will be instantiated when this code is run. This makes both of these
services lazy!

You can see the closure rule listed above in action. In the second example,
`$app` is passed to the closure as a function argument. In the first example,
this is not the case.

Laziness is very important when writing a service provider, so keep it in mind
as you read about the `register()` and `boot()` methods. You can split your
code up correctly but you if you get the laziness wrong you can still run into
problems.


## The register() Method

The purpose of the `register()` method is to configure the service container. In
practical terms, this means setting parameters, defining new services, or
extending existing services. Thats it!

For all intents and purposes, it is better to think of the method signature for
`register()` to be:

    public function register(\Pimple $container)
    {
        // Define services here.
    }

If you can't do it with Pimple, you probably shouldn't be doing it in `register()`!
So it is best to forget about anything else you might otherwise do with `Application`,
like `get()`, `post()`, `mount()`, `before()`, etc.

So, again, the only things that should be done in `register()` are **setting
parameters**, **defining new services**, or **extending existing services**.

This will become more obvious in the future when Pimple service providers
become a reality. At that point, the method signature for `register()` will actually
be similar to what was written above, it will type hint `Pimple`. Until then, the Silex
`ServiceProviderInterface` is going to continue to type hint Silex `Application` as an
argument to `register()`. Don't let this fool you! You've been armed with knowledge!
You should not actually be doing anything specific to `Application` in `register()`.


## The boot() Method

The `boot()` method is called after all of the service providers have registered
themselves and after any inline services have been defined. The documentation for
`ServiceProviderInterface` states that `boot()` can be used for "dynamic"
configuration using services.

This is also a safe place to tie into `Application` specific methods. For example
a service provider could choose to `mount()` a controller provider or it could
choose to register a middleware like `before()` or `after()` from the `boot()`
method.

While it is technically considered safe to access services from the service container
at this point it is a good idea to keep in mind that services used in `boot()` will be
instantiated for *every request*.


## Conclusion

Service providers are invaluable in helping to modularize a Silex application but
writing them incorrectly can be the source of many headaches and hidden performance
problems. Hopefully this will help prevent some of the more easily avoidable mistakes.

These are somewhat tricky topics and can easily trip up even people who have been
working with Silex for awhile. Have questions? There is quite a cool community brewing
in [#silex-php](irc://irc.freenode.net/silex-php) on Freenode. There are often people
there willing to help out!