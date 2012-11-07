---
layout: post
title: "Adjusting Django Form Field Attributes From a View"
date: 2012-11-06 13:02
tags: django
---
I wanted to set a sane default number of rows for `fields.TextArea` in
forms.py but wanted to be able to override that value from a view based
on whether or not the view was going to be rendered as a modal.

The solution:

{{ gist(4028300) }}
