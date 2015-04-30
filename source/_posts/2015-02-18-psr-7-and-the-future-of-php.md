---
title: PSR-7 and the future of PHP
tags:
    - php
    - php-fig
    - psr-7
    - stackphp
social_image: /images/posts/2015-02-18-social.png

---

At long last [PSR-7 HTTP Message Interface](https://github.com/php-fig/fig-standards/blob/master/proposed/http-message.md) ([meta](https://github.com/php-fig/fig-standards/blob/master/proposed/http-message-meta.md)) is finally [up for review](https://groups.google.com/d/msg/php-fig/rQgQmEMtcdk/GYMiQesvAigJ)! I've been tracking this since [Benjamin Eberlei ](https://twitter.com/beberlei) sent his first [pull request](https://www.google.com/url?q=https%3A%2F%2Fgithub.com%2Fphp-fig%2Ffig-standards%2Fpull%2F24&sa=D&sntz=1&usg=AFQjCNGTRVc02dmh1cs2mKbctby6rfimQQ) for what he considered at the time [a proposal for a HTTP client](https://groups.google.com/d/msg/php-fig/kFEhviETdGM/0qXniQA4WcIJ) close to three years ago. This one has been a long time coming!

<div class="video-container">
    <iframe width="853" height="480" src="//www.youtube.com/embed/neq7o8DG68k" frameborder="0" allowfullscreen></iframe>
</div>

I had a chance to [talk about it on PHP Town Hall](http://phptownhall.com/blog/2014/03/06/episode-20-a-nice-friendly-chat-about-sculpin-guzzle-and-psr-7/) with [Michael Dowling](https://twitter.com/mtdowling) just over a year ago. It was the first time I talked openly about wanting to see the current proposal eventually become something that could be the basis for a common HTTP layer that could be used on the server side as well.

Since then, Michael stepped down from working on PSR-7 but it was later [picked up](https://groups.google.com/forum/#!msg/php-fig/CTPRa2XP8po/zCmGGxktD3EJ) by [Matthew Weier O'Phinney](https://twitter.com/mwop). We had a chance to talk in person about it at [Madison PHP 2014](http://2014.madisonphpconference.com/) just before he officially took on the role of editor. I could tell that Matthew was super excited about it and was very much inline with my visions for the future as well.

> In a nutshell: what I dream of for PHP is that we stop thinking of ourselves as Zend Framework, or Symfony, or Laravel, or Aura, or FrameworkFlavorOfTheDay developers, but instead think of ourselves as PHP, HTTP, or Web developers.
> <br><br>— Matthew Weier O'Phinney, September 2014

The work I've done on [Stack](http://stackphp.com/) was meant to be a reference for what working at the HTTP layer in PHP could look like. While it would have been great for Stack to truly be framework agnostic, tying Stack to HTTP Kernel Interface meant that this was always going to be an uphill battle. Still, Stack *was* able to show what it would look like at a smaller scale by allowing people to write code that could be shared between projects/frameworks within the Symfony ecosystem.

I'd love for people to start writing code *for PHP* rather than code for Symfony, Zend Framework, Laravel, CodeIgniter, WordPress, and so on. PHP has already started to move away from silos because Composer makes it so much easier to write and share packages. Still, far too many packages are written in the glue language of their favorite framework. If enough projects adopt PSR-7 I expect that we will see even more sharing of code in the PHP community than we are already seeing.
