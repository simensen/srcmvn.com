---
layout: post
title: Dropping a PostgreSQL Database
date: 2012-11-27 15:17
tags:
    - cheat
    - cli
    - postgresql

---
I wanted to trash and recreate a [PostgreSQL][1] from scratch. PostgreSQL
roles and security stuff are still a bit weird to my MySQL brain, so it
took awhile to find an easy way to accomplish this:

    sudo -u postgres dropdb dbname

I'm sure there are other ways to do this but this seems to be the
easiest.

[1]: http://www.postgresql.org/
