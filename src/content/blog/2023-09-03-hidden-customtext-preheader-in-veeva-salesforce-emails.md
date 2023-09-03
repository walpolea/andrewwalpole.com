---
tags:
  - post
  - published
  - web
title: Hidden customText Preheaders in Veeva/Salesforce Emails
slug: hidden-customtext-preheader-in-veeva-salesforce-emails
summary: Once thought to be an impossible ask, here's a simple workaround to allow customText hidden preheaders in Veeva and Salesforce emails.
date: 2023-09-03 12:00:00
# blogcast: "https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/hidden-customtext-preheader-in-veeva-salesforce-emails.mp3"
---

# Hidden customText Preheaders in Veeva / Salesforce Emails

Here's a very specific one in hopes of preventing someone from having the fraught Google expedition I had.

My job has me moderately learning and working in Veeva for email development. This is essentially a document-based CMS that lets you stitch parts and pieces of files and code together to build fairly complex customizable emails and other experiences. One feature is the `customText` directive which allows you to inline multiple string choices within any set of text. Something like:

```
{{customText[Here is a custom option|And this is a another custom option|And one more for good measure]}}
```

Useful!

Another email-specific concept relevant to this story is Preheaders. Many email clients take the first few sentences of text in an email and append it after the subject in their interfaces so the user has a little more context as to what the email is about. Given that, it's a little bit of a marketing hack to create this idea of Preheaders, or hidden text that comes first in the body copy of the email so that the email clients show specifically chosen text rather than the actual starting text of the email message. Sneaky!

A set of preheader code might look like this:

```html
<span class="preheader" style="font-size:0px;line-height:0px;max-height:0px;max-width:0px;mso-hide:all !important;overflow:hidden;visibility:hidden;display:none;">Hey this is my preheader text</span>
```

Just a `<span>` with a bunch of inlined ways to make it visually disappear from various email clients.

## The Problem

Ok, now that we're up to speed, what if we want to combine these two things: `customText` hidden preheaders? Well you can't do it, at least that's what the internet has to say about it. What's the issue? When you load an email from Veeva into Salesforce it sees the `customText` directive and proceeds to replace it with a `<select>` dropdown of your options. The only problem is that it renders within the email markup that the `customText` lives in, so:

```html
<span class="preheader" style="font-size:0px;line-height:0px;max-height:0px;max-width:0px;mso-hide:all !important;overflow:hidden;visibility:hidden;display:none;">
  {{customText[This is the first optional hidden preheader|And this is a second optional hidden preheader]}}
</span>
```

In the Salesforce email editor becomes something like:

```html
<span class="preheader" style="font-size:0px;line-height:0px;max-height:0px;max-width:0px;mso-hide:all !important;overflow:hidden;visibility:hidden;display:none;">
  
  <!--  Salesforce adds in this <select> for the choices:  -->
  <span class="AE_customText" tagtext="customText" required="false">
    <select id="0" class="hideCustomTextValues">
      <option id="0_0" value="This is the first optional hidden preheader">This is the first optional hidden preheader</option>
      <option id="0_1" value="This is the first optional hidden preheader" style="display: none" hidden="">This is the first optional hidden preheader</option>
      <option id="0_2" value="And this is a second optional hidden preheader">And this is a second optional hidden preheader</option>
      <option id="0_3" value="And this is a second optional hidden preheader" style="display: none" hidden="">And this is a second optional hidden preheader</option>
    </select>
  </span>
  
</span>
```

See the problem? The `<select>` is within your hidden preheader markup, so as you might expect, it doesn't render the dropdown in Salesforce!

## The Solution

So how can we fix this? We need to show the dropdown in Salesforce but continue to hide it in our final rendered emails. Enter the fairly new CSS `:has()`!

We can select the `.preheader` class by looking to see if it contains Saleforce's `.AE_customText` class, and undo all the hiddenness of the preheaders, like so:

```css
@supports selector(:has(*)) {
  .preheader:has(.AE_customText) {
    display:block !important;
    opacity:1 !important;
    visibility:visible !important;
    overflow:unset !important;
  }
}
```

Salesforce will now show the dropdown so you can make a choice, but when the email is rendered anywhere else the `.AE_customText` class won't exist and none will be the wiser!

Here's a codepen of the full solution:

<p class="codepen" data-height="300" data-default-tab="result" data-slug-hash="jOXMVJE" data-user="walpolea" style="height: 300px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;">
  <span>See the Pen <a href="https://codepen.io/walpolea/pen/jOXMVJE">
  Email css for salesforce optional preheaders</a> by Andrew (<a href="https://codepen.io/walpolea">@walpolea</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>
<script is:inline async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>