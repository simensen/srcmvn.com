Source Maven Coding Blog
========================

This repository contains (almost) everything that makes up [srcmvn.com](http://srcmvn.com/).

Powered by [Sculpin](http://sculpin.io). =)

&copy; Beau Simensen


Build
-----

### If You Already Have Sculpin

    sculpin install
    sculpin generate --watch --server

Your newly generated clone of [beau.io](https://beau.io) is now
accessible at `http://localhost:8000/`.

### If You Need Sculpin

    curl -sS https://sculpin.io/installer | php
    php sculpin.phar install
    php sculpin.phar generate --watch --server
