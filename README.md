Advanced Custom Fields in W4 Post Lists
===

Simple WordPress plugin that exposes `[acf]` shortcode to W4 Post List templates.

Use
---

`[acf fieldname]` or `[acf field=fieldname]` in a W4 Post List template.
Nested/grouped ACF fields can be accessed using dot notation: `[acf field=group.subfield]`

Todo
---

- Enable turning off default ACF formatting
- Allow data to be pulled from posts other than the current `$post`
