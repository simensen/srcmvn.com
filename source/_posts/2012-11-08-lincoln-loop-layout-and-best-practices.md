---
layout: post
title: "Lincoln Loop Layout and Best Practices"
date: 2012-11-08 13:42
tags:
    - cheat
    - django

---
Early into my adventures with Django I saw a few references to [Lincoln Loop][0].
Turns out they have provided some pretty decent Django materials including
[Django Best Practices][1].

I had seen some references to Django Loop's [django-startproject][2] which
referenced the [Django Best Practices][1]. However, the Best Practices actually
say to start a project with [django-layout][3] which looks to be more modern.

As I'm bound to need to know this in the future and am bound to always get
it wrong, here is the command to correctly start a project based on the more
modern of Lincoln Loop's layouts:

    django-admin.py startproject \
        --template=https://github.com/lincolnloop/django-layout/tarball/master \
        -e py,rst,example,gitignore my_project_name

[0]: http://lincolnloop.com/
[1]: http://lincolnloop.com/django-best-practices/
[2]: https://github.com/lincolnloop/django-startproject
[3]: https://github.com/lincolnloop/django-layout
