---
layout: blog_base.njk
tags: 
  - post
title: The main title
date: Created
permalink: "blog/{{page.fileSlug}}/index.html"
url: "blog/{{page.fileSlug}}/index.html"
hide: true
---

{{page.date | readableDate}}
# {{title}}

---

## Heading 2

### Heading 3

#### Heading 4

##### Heading 5

**bold text**
*italicized text*

1. This is a
2. numbered
3. list

- This is a
- bulleted
- list
  - with
  - sub-items

`console.log("some code here");`

```js
{
  "firstName": "John",
  "lastName": "Smith",
  "age": 25
}
```

> this is a blockquote, it could span quite a lengthy amount of text, so you have to be prepared for anything


[Link!](/)

![An example image](https://placeimg.com/200/200/tech)

