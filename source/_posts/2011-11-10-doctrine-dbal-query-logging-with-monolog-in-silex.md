---
layout: post
title: "Doctrine DBAL query logging with Monolog in Silex"
date: 2011-11-10 22:48
comments: true
tags:
    - silex
    - symfony
    - doctrine-dbal
    - monolog

---
{% block excerpt %}
I recently had an opportunity to try out [Silex](http://silex.sensiolabs.org)  for a small project. I'm enjoying it so far, which is a good sign that I'll enjoy working with [Symfony](http://symfony.com) as Silex is heavily based on [Symfony Components](https://github.com/symfony/symfony/tree/master/src/Symfony/Component). One thing that I found to be missing out of the box was a way to log [Doctrine DBAL](http://www.doctrine-project.org/projects/dbal) queries.
{% endblock %}

{% block content %}
I recently had an opportunity to try out [Silex](http://silex.sensiolabs.org)  for a small project. I'm enjoying it so far, which is a good sign that I'll enjoy working with [Symfony](http://symfony.com) as Silex is heavily based on [Symfony Components](https://github.com/symfony/symfony/tree/master/src/Symfony/Component). One thing that I found to be missing out of the box was a way to log [Doctrine DBAL](http://www.doctrine-project.org/projects/dbal) queries.

This is especially noticeable when something bad happens and all you have to go on is a vague error like:

    PDOException: SQLSTATE[HY000]: General error: 1 near " ": syntax error

Yay for not having a lot to go on, right? Thankfully it turned out to be pretty easy to enable query logging. With a little guidance from [@igorw](https://github.com/igorw) I was able to:

 * Configure Doctrine DBAL to use a DebugStack logger
 * Tie into [Monolog](https://github.com/Seldaek/monolog) via the built in [Monolog Producer](http://silex.sensiolabs.org/doc/providers/monolog.html) (my application was already using Monolog)
 * Write `after` and `error` [event handlers](http://silex.sensiolabs.org/doc/usage.html#before-and-after-filters) to consume the logged queries

Here is the full solution:

    if ( $app['debug'] ) {
        $logger = new Doctrine\DBAL\Logging\DebugStack();
        $app['db.config']->setSQLLogger($logger);
        $app->error(function(\Exception $e, $code) use ($app, $logger) {
            if ( $e instanceof PDOException and count($logger->queries) ) {
                // We want to log the query as an ERROR for PDO exceptions!
                $query = array_pop($logger->queries);
                $app['monolog']->err($query['sql'], array(
                    'params' => $query['params'],
                    'types' => $query['types']
                ));
            }
        });
        $app->after(function(Request $request, Response $response) use ($app, $logger) {
            // Log all queries as DEBUG.
            foreach ( $logger->queries as $query ) {
                $app['monolog']->debug($query['sql'], array(
                    'params' => $query['params'],
                    'types' => $query['types']
                ));
            }
        });
    }

This can be added at any point after the Doctrine Provider has been registered.

A potential enhancement to this solution would be adding another configuration option to the application to disable the `after` event as there is no point in filling up the `development.log` with queries when things are working as expected.
{% endblock %}
