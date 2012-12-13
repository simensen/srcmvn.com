---
layout: post
title: "Symfony Finder Date Comparator Granularity"
date: 2012-12-12 21:45
tags:
    - symfony

---

I recently ran into a hidden limitation in [Symfony's][0] [Finder][1] component.
The `find` backed adapters use `-mmin` to do their "modified since" comparing
and *not* the PHP based date comparator like I had assumed. This is important
because it turns out `-mmin` is only accurate to a minute.

The problem showed up in [Sculpin][2]. Until I am able to integrate with some
fancy [inotify][3] tools Scupin is stuck polling the source directory with
Finder every few seconds while in `--watch` mode.

Finder was able to find changed files pretty easily. However, each time Finder
ran *after* a file was found to be updated it would show the same file(s) as
having been updated. I nearly pulled my hair out trying to figure out why this
was happening.

The answer, of course, was that even though I was setting my date constraint
down to the second (based on the files actual updated time in seconds) that
time was being converted to a minute by the `find` adapter. The end result
being that the same file would show up as having been "updated" for up to a
full minute.

My workaround was to run an additional check on the updated time of each file
found to ensure that any file returned by finder has actually been updated since
the previous check. Far from ideal, but it works for now.

Completely unrelated, I'd really like to get my hands on the mythical [resource][4]
[watcher][5] [component][6].

[0]: http://symfony.com
[1]: https://github.com/symfony/Finder
[2]: http://sculpin.io
[3]: http://en.wikipedia.org/wiki/Inotify
[4]: https://github.com/symfony/symfony/pull/391
[5]: https://github.com/symfony/symfony/pull/3961
[6]: https://github.com/symfony/symfony/pull/4605