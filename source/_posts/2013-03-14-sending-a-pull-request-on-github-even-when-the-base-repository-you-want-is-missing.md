---
layout: post
title: Sending a Pull Request on GitHub Even when the Base Repository You Want is Missing
date: 2013-03-14 19:00
tags:
    - github

---

You want to help out on a large project. You find a Pull Request that someone else
is working on and decide you want to help out. You make your changes and are ready
to send a Pull Request but to your surprise you find that the fork you want to send
your PR to is not listed. What now?

It turns out this is a known limitation with [GitHub's][1] Pull Request
implementation for network with many repositories. If there are too many forks
GitHub filters the list to only include the most popular forks.

I've run into this a number of times, usually when trying to work with the
[php-fig/fig-standards][2] repository. More often than not, if I want to send
changes to someone else's proposal (a *very* common use case) I'll find that their
repository is not listed in the "base repo" selection list:

![base repo example]({{site.url}}/images/posts/2013-03-14_1844.png)

I've contacted GitHub about this several times. This most recent time I got antsy
and started poking around while waiting for a response and came to a workaround
on my own. Huzzah!

I received an email the next day stating that the team is "discussing ways to
address this particular issue with large repository networks." It also included
instructions on the same workaround. :)

## The Workaround

It turns out it is pretty easy to get around this limitation with a little URL
hacking. Using my example above as a reference, I can target a PR at any base
repo I want using the following pattern and replacing `base-repo-username` and
`base-branch` as needed:

> https://github.com/simensen/fig-standards/pull/new/base-repo-username:base-branch...simensen:is-hit-is-miss

So if I want to send something to, say, [tedivm's Cache proposal][3], I would
use the following URL since the `base-repo-username` is `tedivm` and the `base-branch`
would be `Cache`:

> https://github.com/simensen/fig-standards/pull/new/tedivm:Cache...simensen:is-hit-is-miss

I've had mixed luck on what actually happens when loading the hacked URL. In at
least one case either the "commits" or "files" tabs was missing content on viewing,
despite having the correct number of items listed in the tabs. The PR worked just
fine, though, so if you see this I don't think there is a lot of reason to be alarmed.

Hopefully GitHub will support this functionality natively sometime in the near
future. Until then, this workaround should help people currently stuck on this problem.


[1]: https://github.com
[2]: https://github.com/php-fig/fig-standards
[3]: https://github.com/php-fig/fig-standards/pull/17