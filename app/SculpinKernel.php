<?php

use Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel;

class SculpinKernel extends AbstractKernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return array_merge(parent::registerBundles(), array(
            new \Dflydev\Bundle\GitHubGistTwigBundle\DflydevGitHubGistTwigBundle,
        ));
    }
}
