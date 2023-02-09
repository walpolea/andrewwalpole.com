import rss from '@astrojs/rss';
import sanitizeHtml from 'sanitize-html';
import MarkdownIt from 'markdown-it';

import { getCollection } from 'astro:content';

const blog = await getCollection('blog');

const parser = new MarkdownIt();

export function get(context) {
  return rss({
    title: 'Andrew Walpole\'s Blog',
    description: 'A blog about web development, engineering leadership, digital strategy and the occasional off-topic rant.',
    site: context.site,
    items: blog.map((post) => ({
      title: post.data.title,
      pubDate: post.data.date,
      description: post.data.summary,
      link: `/blog/${post.slug}/`,
      content: sanitizeHtml(parser.render(post.body)),
      ...post.data,
      author:`andrew@andrewwalpole.com (Andrew Walpole)`,
      customData: post.data.blogcast ? `<enclosure url="${post.data.blogcast}" type="audio/mp3" />`:''
    })),
    customData: `<language>en-us</language>`,
  });
}