---
layout: post
title: "Octopress vs. Jekyll: Fight!"
date: 2011-11-16 21:48
comments: true
tags: jekyll octopress ruby

---

{% block excerpt %}
After spending a few nights looking into [Jekyll](https://github.com/mojombo/jekyll) and digging into how [other Jekyll sites](https://github.com/mojombo/jekyll/wiki/sites) ticked, I came away a little frustrated. So I hit up [#BeerAndCodeSeattle](http://seattle.beerandcode.org/) to see if anyone else had a similar experience with Jekyll. [@smoak](http://mybrainoncode.com) suggested I check out [Octopress](http://octopress.org/).
{% endblock %}

{% block content %}
After spending a few nights looking into [Jekyll](https://github.com/mojombo/jekyll) and digging into how [other Jekyll sites](https://github.com/mojombo/jekyll/wiki/sites) ticked, I came away a little frustrated.

For example, I *really* liked how [metajack](http://metajack.im) was structured but some of the basic layout stuff was not working correctly for my site. An hour or so later, I discovered that metajack is running on a [patched Jekyll fork](https://github.com/metajack/jekyll) that has not been updated since [2009](https://github.com/metajack/jekyll/commits/master). Joy.

I hit up [#BeerAndCodeSeattle](http://seattle.beerandcode.org/) to see if anyone else had a similar experience with Jekyll. [@smoak](http://mybrainoncode.com) suggested I check out [Octopress](http://octopress.org/).

Octopress looked great on the surface! It came with a nice theme and a bunch of code display related plugins. It was not long before I started bump into a few issues, though.

The biggest being that Octopress is structured in such a way that your site's content is supposed to live in the Octopress directory itself. This is great if you want to fork Octopress and get a blog started quickly. Not so good once you want to try and get an updated version of Octopress merged into your code.

Documentation is provided on how how to [update the code](http://octopress.org/docs/updating/) but it does not address the fact that many important pieces (like, say, `_config.yml`) are a part of the Octopress repository. I can only imagine the amount of conflict fun there would be after a big update…

I've spent the last few nights trying to figure out how to best separate my site's content from the Octopress directory with as little impact on the existing code as possible. I think I'm getting close to cracking this but it is going to require some relatively heavy lifting in the guts of Octopress to really do it right.

All in all, Octopress is a nice step up from Jekyll in that a lot of work has been done to provide a nice looking theme, a solid set of plugins, and functionality. What you get for free you pay for in complexity and a loss of flexibility.

I am hoping that the latter will be addressed sooner rather than later. And by the looks of work going into [this branch](https://github.com/imathis/octopress/tree/move_rakefile_configs) I think that will definitely be the case!
{% endblock %}
