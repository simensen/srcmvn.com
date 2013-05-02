---
externalLink: https://igor.io/2012/11/09/scaling-silex.html
layout: post
title: Scaling a Silex Code Base
date: 2012-11-19 10:10
tags:
    - silex
    - php
    - opinion

---

> One common misconception about silex and microframeworks in
> general is that they are only suited for small, simple apps,
> APIs and prototyping. Of course, those use cases are the
> main selling point, but they are by no means the limit of
> what is possible.
> <footer>— <a href="https://igor.io/2012/11/09/scaling-silex.html">Igor Wiedler discusses "scaling" Silex</a></footer>

I've mentioned a few times that I think Silex can be difficult for
new users because Silex has no structure. It definitely gives people
some skewed impressions on its capabilities if all they really have
to work from is:

    require_once __DIR__.'/../vendor/autoload.php'; 

    $app = new Silex\Application(); 

    $app->get('/hello/{name}', function($name) use($app) { 
        return 'Hello '.$app->escape($name); 
    }); 

    $app->run(); 

Powerful? Yes! Useful as a starting point for a real application?
Probably not.

I think articles like Igor's, along with a few sample Silex projects
of varying complexity, will help people new to Silex realize that
there is more than one way to do it and that Silex apps can either
be tiny and minimal or as complexed and organized as any full stack
framework.
