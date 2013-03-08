---
layout: post
title: PHP-FIG Focus
date: 2013-03-04 10:40
tags:
    - php
    - php-fig
    - opinion
    - psr-2

---

I'm a huge fan of [PHP-FIG][1]. I take part where I think I can make a
constructive contribution and I try to tune in to as many of the discussions
as my time allows. So when I saw [Larry's poll about the Focus of FIG][2]
I was happy to have the opportunity to share what I think PHP-FIG should be
focusing on. This sparked an [interesting conversation][3] about whether I
thought PSR-2 was a waste of time.

---

Larry specifically requested that people simply vote and not discuss the issue.
I think this was a great idea and people have done a pretty good job of following
this request. A downside to this is that people may wonder why someone votes the
way they do when there is zero context for their vote.

[Hari][4] asked for more context from me on Twitter. I was happy to talk about it
and I thought the discussion went well and was productive. However, I also found
it hard to really express some of these complex ideas in 140 character bursts. So
I told him I'd write about why I voted the way I did in more detail.

---

I was surprised that PHP-FIG got involved with PSR-2. I did not think that
it was something that would further the groups goals. There were other
interesting things happening at that point but the entire focus of the group
turned to... a style guide? Really?

As far as I was concerned, the process for creating PSR-2 drew a lot of time
and energy from places it could have been better spent. Since then PSR-2 has
been a PR nightmare and a drain on resources.

This does not mean that I am not actively trying to write valid PSR-2 nor does
it mean I don't see utility in having it available now that it already exist.
Quite the opposite, in fact. How do I explain this duality?

First, it was done and it is now a thing. Why fight it?

Second, it was more or less compatible with Symfony CS. I had never had a formal
CS for any of my projects in the past and I had recently decided to adopt Symfony
CS for all of my projects. This is hugely important so it deserves some emphasis.
*Adopting PSR-2 for me meant **changing nothing about the way I was already writing
code**.*

Third, the notion of PSR-2 being an open and independent standard *not tied
directly to the Symfony framework* meant that in theory I would be more likely to
find other projects using my preferred personal/project CS. As someone who likes
to promote writing framework agnostic code, this is a huge win!

So I can see how from the outside it would appear that I don't actually think that
PSR-2 was a *complete* waste of time. Why did I vote 10, "Specs along the lines of
PSR-3 that affect code-level interop. *PSR-2-esque specs are a waste of time*,"
instead of something a little softer?

PSR-2 exists now. There is nothing we can do about it. I actually find it to be
useful and serving a purpose. That is a good thing! But this does not mean that I
think PHP-FIG should spend resources on creating more specs like PSR-2.

For example, I think that proposals along the lines of [SQL formatting standards][5]\*
are just begging for trouble. Discussions like these are going to end up eating valuable
resources and the end results will have a high probability of making even more people
unhappy.

I would rather have PHP-FIG focus on bringing things like a Cache interface to the table
than publishing something telling people how they should write a properly PSR formatted
SQL query.

That said, I've learned over the last few years that [some people think that interfaces
may be a bad idea as well][6]. So I guess you really can't make everyone happy. :)

In the end, I think that on average PHP-FIG will probably score somewhere in the middle.
Some things will be more targeted at humans. Some will be more targeted at computers.

If I had a vote, though, I would vote that the group aim at computer related specs for
awhile. I would vote for this in the hopes of getting some more wins in the group's column
and hopefully avoid fresh human drama brought on by human oriented specs. Someday it may
be safe to soften this stance, but for now I think this is the best way for PHP-FIG to
move forward.

*\* I picked the SQL query example because it was the first thing that came to mind and I
thought it made a great example of a human oriented spec. I realize the SQL PR was already
closed at the time of writing. :)*


[1]: http://www.php-fig.org
[2]: https://groups.google.com/d/topic/php-fig/wNICVGwjE9s/discussion
[3]: https://twitter.com/harikt/status/308077012138995714
[4]: https://twitter.com/harikt
[5]: https://github.com/php-fig/fig-standards/pull/85
[6]: http://www.mwop.net/blog/2012-12-20-on-shared-interfaces.html
