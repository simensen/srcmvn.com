---
layout: post
title: An Update on Sculpin, my PHP Static Site Generator
date: 2012-12-04 10:31
tags:
    - sculpin
    - symfony
    - react

---
Although my workday has been filled with [Python][1] and [Django][2],
my early mornings and late nights have been filled with working on
several personal PHP projects. One of the projects that has finally
been getting some love again is [Sculpin][3], my PHP static site
generator.

Sculpin is a PHP static site generator built around [Symfony's][8]
[HTTP Kernel][9]. Since Thanksgiving I have been putting a lot of
work in on it again and I am starting to feel really good about it.

It is still unstable but it has all of the features *I* would consider
critical for a static site generator. Specifically, Sculpin now has
support for generators. Generators made it possible to provide support
for Pagination and Post tags. Both of these features are now in use on
this site.

Other cool Sculpin related things have happened in the last few weeks as
well. Sculpin now has an embedded web server thanks to the [React][4]
project and Sculpin has its first Skeleton on [Packagist][5]. This means
that if someone wants to try Sculpin out they can do so in 3-4 commands.

Interested in trying out Sculpin? Check out the [documentation][6] on
the Sculpin site or read the README from the [Sculpin Blog Skeleton repository][7] to see how to bootstrap a Sculpin blog in under five minutes!

([previously][10])

[1]: http://www.python.org/
[2]: https://www.djangoproject.com/
[3]: http://sculpin.io/
[4]: http://reactphp.org/
[5]: http://packagist.org/
[6]: http://sculpin.io/documentation/
[7]: https://github.com/sculpin/sculpin-blog-skeleton
[8]: http://symfony.com/
[9]: https://github.com/symfony/symfony/tree/master/src/Symfony/Component/HttpKernel
[10]: {{site.url}}/blog/2012/02/19/something-new/
