Source Maven Coding Blog
========================

This repository contains (almost) everything that makes up [srcmvn.com](http://srcmvn.com/).

Powered by [Sculpin](http://getsculpin.com). =)

&copy; Beau Simensen

Build
-----

    wget http://getcomposer.org/composer.phar
    php composer.phar install
    php vendor/bin/sculpin generate

### Development Configuration

Create a development configuration file (`app/config/sculpin_site_dev.yml`)
so that the generated URLs will make sense for your environment. By default,
the development build will be placed into `output_dev` so make sure to include
that in your URL.

Example:

    imports:
        - sculpin_site.yml
    url: http://my.local/websites/srcmvn.com/output_dev
