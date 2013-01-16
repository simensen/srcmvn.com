---
layout: post
title: Django Advanced Model Choice Field
date: 2013-01-15 19:57
tags:
    - django
    - python

---

Django's `ModelChoiceField` only allows for a **string** label for each individual
choice. While it can be customized to allow for a user to change what that string
should look like it is still limited to being just a string.

In my project I wanted to have the choices built out in a more rich way than simply
displaying a string label. In order to do this I wanted my template to be able to
access the full model object for each choice to aid in rendering.

For choice fields the `form.my_field.choices` list contains a tuple in the form of
`(value,label)`. What I was looking for was `(value,label,model)`. In order to make
it available I created a custom field type based on `ModelChoiceField` called
`AdvancedModelChoiceField`.

This is the solution I came up with:

    from django.forms import models
    from django.forms.fields import ChoiceField

    class AdvancedModelChoiceIterator(models.ModelChoiceIterator):
        def choice(self, obj):
            return (self.field.prepare_value(obj), self.field.label_from_instance(obj), obj)

    class AdvancedModelChoiceField(models.ModelChoiceField):
        def _get_choices(self):
            if hasattr(self, '_choices'):
                return self._choices

            return AdvancedModelChoiceIterator(self)

        choices = property(_get_choices, ChoiceField._set_choices)


This changes the choice tuple to `(value,label,model)` while hopefully
leaving the rest of the object's behavior intact. It seems to work so far
and I have not seen any weird side effects yet.

The original `ModelChoiceIterator` was extended to simply add the object
to the end of the choice tuple. The original `ModelChoiceField` needed
to be updated to return an instance of `AdvancedModelChoiceIterator` instead
of the original `ModelChoiceIterator`.

I learned something new about Python in the process. `property` is a strange
little thing. I could not simply redefine `_get_choices`, I actually needed
to redefine the property itself.

An simple example of a template leveraging this change:

    {% verbatim %}<fieldset>
        <legend>Package <small>how your account will be billed</small></legend>
        <div class="control-group {% if form.package.errors %}error{% endif %}">
            <label class="control-label">{{ form.package.label }}</label>
            <div class="controls">
                <ul>
                    {% for choice in form.package.field.choices %}
                        <li>
                            <input type="radio"
                                   name="{{ form.package.name }}"
                                   value="{{ choice.0 }}"
                                   {% if form.package.value"|safe} == choice.0|safe %}
                                       checked="checked"
                                   {% endif %}
                            >
                            <strong>{{ choice.2.name }}</strong>
                            <span class="price">{{ choice.2.price }}</span>
                        </li>
                    {% endfor %}
                </ul>
                {% if form.package.errors %}
                    <span class="help-block">{{ form.package.errors }}</span>
                {% endif %}
            </div>
        </div>
    </fieldset>{% endverbatim %}

This renders a `<ul>` with a radio `<input>` for each choice along with some additional
data like the choice's name and the choice's price. This could easily also be attached
media or any other bits of metadata accessible via the model.

I had people suggest to "do it in a widget" but as far as I can tell the widgets get
the same amount of data. In this case I'd still only end up with the value and the
string label.

I prefer building my forms in templates anyway. Maybe I'll get the hang of widgets
at some point but until then I'm happy with the amount of control this gives me.

I'm still pretty new to Django so there very well may be a better way to accomplish
the same thing. Please share if you know something better. :)