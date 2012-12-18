---
layout: post
title: A Pimple Console Service Provider
date: 2012-12-17 17:15
tags:
    - pimple
    - silex
    - cilex
    - symfony

---

What started out as an [RFC][1] for adding a Console Service Provider to [Silex][2]
resulted in a few fun personal discoveries.

First, [Pimple][3] is useful beyond just Silex. I came to understand that most of
the "Silex" code I have been writing has really been generic service providers. There
really was nothing tying them to Silex in any way other than the fact I was using
them in a Silex application.

Second, [Cilex][4] at its core was essentially identical to my Silex Console Service
Provider RFC.

    $this['console'] = $this->share(
        function () use ($name, $version) {
            return new Console\Application($name, $version);
        }
    );

I saw this as an opportunity to try and bridge the Silex and Cilex communities
rather than trying to make something specific for Silex. I also saw it as an
opportunity to explore the notion of generic Pimple service providers and how
they could work right now even without the benefit of [native Pimple Service
Providers][6]. The more I thought about it the more I liked how nicely these
goals played into each other.

I contacted the Cilex team to see whether or not they would be interested in
working with me to integrate a standalone generic Pimple console service provider
into Cilex and whether or not they'd be interested in distributing the standalone
service provider under the Cilex banner.

The end result is the newly launched [cilex/console-service-provider][5].

What this means is that the heart of Cilex can be a part of *any* Pimple based
application. Developers can now write service providers that can provide
commands in addition to other services by extending the `console` service:

    class MyServiceProvider
    {
        public function register($c)
        {
            if (isset($app['console'])) {
                $app['console'] = $app->share($app->extend('console', function($console, $c) {
                    $console->addCommand(new MyReusableCommand);

                    return $console;
                }));
            }
        }
    }


Since native Pimple Service Providers do not exist yet there is currently no
standard way to register generic service providers to a vanilla Pimple instance.
It is pretty easy to do this manually, though:

    use Cilex\Provider\Console\BaseConsoleServiceProvider;
    
    $app = new Pimple;
    
    $app['console.name'] = 'MyApp';
    $app['console.version'] = '1.0.5';
    
    $consoleServiceProvider = new BaseConsoleServiceProvider;
    $consoleServiceProvider->register($app);
    
    // Register other service providers, some of which may now
    // provide commands!
    
    $app['console']->run();

An adapter is provided to allow the Console Service Provider to be registered
with a Silex application using Silex's own registration method:

    use Cilex\Provider\Console\Adapter\Silex\ConsoleServiceProvider;
    use Silex\Application;
    
    $app = new Application;
    
    $app->register(new ConsoleServiceProvider(array(
        'console.name' => 'MyApp',
        'console.version' => '1.0.5',
    )));
    
    // Register other service providers, some of which may now
    // provide commands!

    $app['console']->run();

For Cilex nothing fancy is needed as the Console Service Provider is baked in:

    use Cilex\Application;
    
    $app = new Application('MyApp', '1.0.5');
    
    // Register other service providers, some of which may now
    // provide commands!

    $app->run();

The only dependencies for the Console Service Provider are Pimple itself and
Symfony Console. This should lower the barrier to entry for someone who might
otherwise not want to require the entire Cilex stack into their project.

It is my hope that Pimple Service Providers become a reality in the very near
future. Hopefully this will result in people writing cross application code
as they will have the option to write Pimple Service Providers instead of
Silex or Cilex specific Service Providers.

Thanks to [@mvriel][7] and the Cilex team for agreeing to work together on
this!

[1]: https://github.com/fabpot/Silex/issues/542
[2]: http://silex.sensiolabs.org/
[3]: http://pimple.sensiolabs.org/
[4]: http://cilex.github.com/
[5]: https://github.com/Cilex/console-service-provider
[6]: https://github.com/fabpot/Pimple/pull/37
[7]: https://twitter.com/mvriel