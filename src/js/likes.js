import { createApp } from 'https://unpkg.com/petite-vue?module';

const likes = ({title}) => {

  const endpoint = 'https://likes.walpolea.workers.dev/';
  return {
    title,
    likes:0,
    likeAdded:false,
    async mounted() {
      console.log('mounted');
      await this.loadLikes();
    },
    async loadLikes() {
      this.likes = (await ( await fetch(`${endpoint}?title=${this.title}`)).json()).likes;
    },
    async postLike() {
      if( !this.likeAdded ) {

        const response = await ( await fetch(endpoint, {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({title})
        })).json();

        this.likes = response.likes;

        this.likeAdded = true;
      }
    }
  }
}

createApp({likes, $delimiters: ['${', '}']}).mount();