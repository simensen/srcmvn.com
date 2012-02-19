---
layout: post
title: "Rails: RVM + Passenger (Standalone behind nginx) + Upstart on Ubuntu 10.04"
date: 2011-12-16 21:06
comments: true
description: "Rails: RVM + Passenger (Standalone behind nginx) + Upstart on Ubuntu 10.04"
tags: ubuntu upstart nginx passenger rvm rails

---

{% block excerpt %}
After testing the excellent [Pivotal Lab's](http://pivotallabs.com/) [Continuous Integration Monitor](https://github.com/pivotal/cimonitor) we decided to use it long-term. This meant we needed to find a way to run the software on boot ([Upstart](http://upstart.ubuntu.com/)) under its own environment ([RVM](http://beginrescueend.com/)) and get [nginx](http://nginx.org/) to reverse proxy the site. This turned out to be a little more difficult than I had hoped but in the end it all was all good.
{% endblock %}

{% block content %}
After testing the excellent [Pivotal Lab's](http://pivotallabs.com/) [Continuous Integration Monitor](https://github.com/pivotal/cimonitor) we decided to use it long-term. This meant we needed to find a way to run the software on boot ([Upstart](http://upstart.ubuntu.com/)) under its own environment ([RVM](http://beginrescueend.com/)) and get [nginx](http://nginx.org/) to reverse proxy the site. This turned out to be a little more difficult than I had hoped.

## RVM and Passenger

RVM is great! Unfortunately it made it more complicated to get something to run under a specific RVM environment at boot. The key turned out to be `rvm wrapper`. It took awhile to discover this nice feature and how to use it effectively.

First, make sure that you are using the correct Ruby. Assuming you have RVM installed (and you've already entered the cimonitor directory at some point) you should be able to execute the following:

    rvm use ree-1.8.7-2011.03@cimonitor

Next, install Phusion Passenger Standalone according to the [standalone user guide](http://www.modrails.com/documentation/Users%20guide%20Standalone.html).

    gem install passenger

Lastly, create a `passenger` wrapper for `ree-1.8.7-2011.03@cimonitor`. This will create a script named `cimonitor_passenger` that contains everything it needs to ensure that `passenger` is called with the appropriate RVM environment.

    rvm wrapper ree-1.8.7-2011.03@cimonitor cimonitor passenger

**Note:** The first time that `cimonitor_passenger start` is run for any given user it will need to download, setup and install its own version of nginx. It might not hurt to run `cimonitor_passenger start` once by hand before trying to load from upstart.

## Upstart

On the surface Upstart looks pretty simple and an improvement over System-V init. However, it can be a huge pain to debug and test and at some point I threw in the towel and created a more standard System-V init style [start|stop] script.

Once everything became more simple with the Passenger RVM wrapper, I was able to try to come up with a simpler upstart script. Here are the contents of our `/etc/init/pivotal_cimonitor.conf`:

{{ gist(1487570) }}

This starts passenger it cimonitor's own RVM and even manages to run it as a non-privileged user. Success!

## nginx

The nginx configuration was more or less a standard reverseproxy setup at this point. Sadly, cimonitor has too many `/path…` hardcoded into its views to be able to be effectively mounted anywhere but at the root.

If anyone finds a way to bypass this I'd love to hear it! But as far as I could tell, there was not going to be any way to have the entire application live under, say, `http://ci.example.com/cimonitor`.
{% endblock %}
