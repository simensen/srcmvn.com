---
layout: post
title: Embedding GitHub Gists
date: 2012-12-19 23:15
tags:
    - wordpress
    - opinion
    - github
    - gist
    - posterous
    - jekyll
    - octopress
    - sculpin

---

> It is my opinion that embedding gists in a blog is a generally bad idea,
> unless you are writing on a site with terrible code support.
> <footer>— <a href="https://twitter.com/imathis/status/281095032038113280">Brandon Mathis takes a stand on embedding Gists</a></footer>

Last week GitHub [released a pretty new version of Gist][2]. Huzzah! Oh wait,
it broke what now?

---

My first attempts at blogging about code involved [WordPress][4]. At the time
there were a wide variety of source code formatters. I *really* didn't like
many of them.

> Posting Source Code with Wordpress is a pain in the ass. Is this really the
> way that the world handles dealing with source code in blogs? I know, not
> everyone in the world uses Wordpress. But a good chunk does. And Blogger's
> support for sourcecode was even worse.
> <footer>— <a href="http://blog.srcmvn.com/wordpress-and-posting-source-code">me back in January 2009</a></footer>

I do not recall how long it took me to find [Posterous][6] but in playing around
with it I discovered it had native support for GitHub Gist. Simply paste the
Gist URL on its own line and **BAM!** instant code shared goodness in all its
nicely styled glory.

I was hooked.

Not long after, I created what to this date might be my most used piece of
software: the [Embed GitHub Gist][7] plugin for WordPress. Things were good.
For a time.

After another year or so I grew weary of maintaining multiple WordPress installations
and eventually moved my blogs to Posterous. It worked well in the beginning. Things
were good again. For a time.

Eventually Posterous began to wear on me. It became slower. Its fancy publishing
features worked only half the time. Its search was whack. I also started to subscribe
to [Dave Winer's opinions][8] on [Corporate Silos][9]. I wanted to host my own content
again but I didn't really want to worry about databases and keeping software up to date.

Around that time I was introduced to [Jekyll][10]. A little later I was introduced
to [Octopress][11]. I was super excited to see that Octopress had a GitHub Gist plugin.
It meant I could more or less continue to feed my blogging by Gist habit.

When I decided to roll my own static site generator ([Sculpin][12]) one of my big
goals was to ensure that it would support plugins. The first plugin I wrote in order
to prove my goal was a Twig extension ([dflydev/github-gist-twig-extension][13])
and a Symfony Bundle ([dflydev/github-gist-twig-bundle][14]). After all, if
I ever wanted to host my coding blog with my own static site generator it
better satisfy my Gist needs, right?

---

It took this new Gist update for me to really come to my senses. Long gone
are the horrible WordPress days in which it was very difficult to properly
embed code in a blog. Brandon is right. If your content platform can handle
code natively and do a pretty decent job at it you should probably just use
that.

Especially when taking into account the silo-free life I'd like my sites to
lead it really makes a lot of sense to just write the code directly into
my content. If I think it is important to share the code in a way that people
can more easily collaborate I can simply link to a Gist.

Looking back I had already started to make this transition. About a month ago
I finally got around to looking into [highlight.js][15] and integrated it into
the Source Maven site. Since then I've only used simple Markdown code blocks
for my source code sharing and things have been pretty nice.

I wish I could say my reasons were more forward looking. My main reason for
making this change was not to rely less on Gist, it was because I was frustrated
by needing to add `<?php` to the first line of my PHP source code for it to be
properly highlighted by Gist.

---

When the full realization of the impact last week's changes would have on
several days worth of my free time I became frustrated. I had built software on
a premise that was starting to feel a lot more fragile than I had previously
realized. I was receiving [support requests][3] for software I myself was no
longer actually using. And to be quite honest, having to dive back into WordPress
PHP did not help my overall attitude *at all*.

I did not see anyone else talking about the problems introduced by the new Gist
until I saw this:

<blockquote class="twitter-tweet"><p>In 2.1 we dropped the js and instead are fetching gists and embedding them statically. It's in the 2.1 branch with no theme updates needed.</p>&mdash; Octopress (@octopress) <a href="https://twitter.com/octopress/status/281093876993912833" data-datetime="2012-12-18T17:49:37+00:00">December 18, 2012</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

First, I wasn't alone! Second, I was pretty impressed that Brandon decided to
take such a strong stance on the issue so quickly.

I've decided to take the same stance for Sculpin. Tonight I removed the GitHub Gist Twig
Bundle from the [Sculpin Blog Skeleton][16]. I am no longer going to promote embedding
GitHub Gists with Sculpin even if it is the best way to show a usable third-party plugin
in action with Sculpin.

---

So where does that leave [Embed GitHub Gist][7]?

I have not often felt as helpless as I did realizing that countless sites relying
on my software were either outright broken or looked absolutely horrible. To add insult
to injury it was not my fault. Nothing changed in my software. I think that is the real
problem here. People were relying on my software to share code from an entirely separate
service. A service that nobody has any real control over.

I do not want to abandon the users of my most popular software but given there are
hopefully better ways to handle this now (either by other WordPress plugins or *moving
off of WordPress if you are doing a developer blog*) I do not think I will be devoting
more resources to this project.

With the fixes from last week it should continue to work as-is until GitHub makes another
breaking change. If someone feels the need to fork it and add additional functionality
down the line I think I'm OK with that at this point. If the time comes to delete it
from the WordPress plugin repository, I think it will be an easy decision.

As for me, I'm going to continue *not* using Gist to do any code examples that
I plan to embed in blog posts.

[1]: https://twitter.com/imathis/status/281095032038113280
[2]: https://github.com/blog/1276-welcome-to-a-new-gist
[3]: http://wordpress.org/support/plugin/embed-github-gist
[4]: http://wordpress.org/
[5]: http://blog.srcmvn.com/wordpress-and-posting-source-code
[6]: https://posterous.com/
[7]: http://wordpress.org/extend/plugins/embed-github-gist/
[8]: http://scripting.com/stories/2011/09/16/corporateBloggingSilos.html
[9]: http://scripting.com/stories/2011/02/14/corporateBloggingSilosInTh.html
[10]: https://github.com/mojombo/jekyll
[11]: http://octopress.org/
[12]: http://sculpin.io
[13]: https://github.com/dflydev/dflydev-github-gist-twig-extension
[14]: https://github.com/dflydev/dflydev-github-gist-twig-bundle
[15]: http://softwaremaniacs.org/soft/highlight/en/
[16]: https://github.com/sculpin/sculpin-blog-skeleton
