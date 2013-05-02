---
layout: post
title: Does it make sense for a VCS based static site generator to have a lite web administration interface?

---

{% block excerpt %}

> Would it defeat the purpose of a VCS based static site generator to build a
> web API to add and edit posts? (think: bookmarklet publishing)
> <footer>— <a href="https://twitter.com/kirkryyn/status/171452203985412098">@kirkryyn</a></footer>

This is a question I have been asking myself for awhile. As much as I like the
idea of a static site generator, having a nice bookmarklet to publish quotes
and found content makes blogging about such things so much nicer.

{% endblock %}

{% block content %}

> Would it defeat the purpose of a VCS based static site generator to build a
> web API to add and edit posts? (think: bookmarklet publishing)
> <footer>— <a href="https://twitter.com/kirkryyn/status/171452203985412098">@kirkryyn</a></footer>

This is a question I have been asking myself for awhile. As much as I like the
idea of a static site generator, having a nice bookmarklet to publish quotes
and found content makes blogging about such things so much nicer.

As excited as I have been about working on [Sculpin](http://getsculpin.com) I
feel like something will always feel missing if I cannot find an easy way to
bootstrap new articles.

I have seen some [interesting solutions](http://jonathanbuys.com/04-05-2011/Jekyll_Bookmarklet.html)
for integrating a bookmarklet type approach with Jekyll but it is not all
that appealing on a practical level.

So I've been thinking about what it would look like to write a lite administration
application for Sculpin. If it could be made generic enough it could probably be
repurposed to support the filesystem of any VCS based static site generator.

There is still much work to be done on Sculpin so I'm probably not going to get
around to this anytime soon. I would love to get some feedback on this, though.
Maybe I missed an existing solution? Maybe there are some good reasons why this
is *not* the way to go? Or maybe there is a huge need for something like this…

{% endblock %}
