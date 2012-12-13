---
layout: post
title: The Question of Static Site Generators
date: 2012-12-13 00:00
tags:
    - opinion
    - sculpin
    - jekyll
    - liquid
    - twig
    - wordpress

---

> for me the point of having my blog as a static site is mainly easy deployment<br>
> I don't have to worry about even configuring PHP<br>
> I just put html on a web server and boom! instant win
>
> <footer>— [Igor Wiedler wins](http://twitter.com/igorwesome)</footer>

One question I get asked pretty frequently after introducing people to [Sculpin][0]
is why they would want to use a static site generator instead of either using a
CMS or  writing a simple [insert microframework-flavor-of-the-day here] application.

I think we've been brainwashed.

In the early days most sites were static. An actual CGI application was relatively
rare by today's standards and was mainly used for forms and actually performing
queries.

Today nearly every site is dynamic whether it needs to be or not. WordPress, which
is entirely dynamic, is used seemingly everywhere with estimates in 2011 that put
WordPress running 25% of *all websites*.

It is only natural, I suppose, that in this environment people have difficulty
understanding how a static site generator could be useful to them. After trying to
explain Sculpin and the concept of static site generators, someone responded by
saying, "Oh, so it's like FrontPage?" *That* is the connotation "static site"
has for some people these days.

I'll admit that it took me awhile to come around to understanding why I'd want to
generate a static site, too. The first time I tried to use [Jekyll][2] I was very
skeptical. It felt awkward and I didn't really understand how we were going to
accomplish the things we wanted to accomplish with the site we were working on at
the time.

It turns out the reasons I was struggling with the whole static site generator concept
was because of *Jekyll itself*. Between its minimalist approach and its limitations in
how it used [Liquid][3] it was never really going to work for me. I just didn't know
enough Ruby or Liquid at the time to figure out what the real problem was at first.

Fortunately the general concept started to grow on me despite some of those early
problems. I found [Octopress][4] and played with that some but I slowly came to the
realization that I was never really going to be able to get behind Jekyll and Octopress
long-term. Thus [Sculpin][0] was born.

Since I've gotten more comfortable with the notion of static site generators I have
published maybe half a dozen websites of varying complexity. All of them static.
Two years ago they probably would have been WordPress sites.

These days I prefer statically generated sites if I can help it. No more working in
WordPress PHP or rolling a one off custom application if it isn't *really* required.
I still get to work with tools I'm familiar with and enjoy. Being able to use high
quality tools like [Twig][1] make all the difference.

To top it off, deployment has been a dream. No more worrying about databases being down.
Just a plain old HTTP server. Igor nailed it. *Instant win.*

Static site generators are not appropriate for every site but they are probably
appropriate for more sites than people realize. The trick is finding a way to help
people understand that not everything needs to be dynamic.

Especially things that are pretty much just static content anyway.

[0]: http://sculpin.io
[1]: http://twig.sensiolabs.org/
[2]: https://github.com/mojombo/jekyll
[3]: http://liquidmarkup.org/
[4]: http://octopress.org/
