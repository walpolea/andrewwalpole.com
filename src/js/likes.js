
const likes = ({title}) => {

  const endpoint = 'https://likes.walpolea.workers.dev/';
  return {
    $template: `
    <article class="like-button" @vue:mounted="mounted" :style="{'--likes':likes}">
      <button @click="postLike();">
        <svg :width="likes + '%'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 78.09 74.75">
          <polygon points="2 34.869 2 13.192 13.181 2 36.04 2 36.04 9.188 43.221 2 64.909 2 76.09 13.192 76.09 34.869 45.464 65.495 39.052 71.92 2 34.869" fill="var(--accent-color)" />
          <path d="M64.08,4l10.01,10.02v20.02l-30.04,30.04-5,5.01L4,34.04V14.02L14.01,4h20.03V14.02l10.01-10.02h20.03m1.658-4h-23.346l-1.172,1.173-3.18,3.183V0H12.352l-1.172,1.173L1.17,11.193l-1.17,1.171v23.333l1.172,1.172,35.05,35.05,2.831,2.831,2.828-2.834,5-5.01,30.037-30.037,1.172-1.172V12.364l-1.17-1.171L66.91,1.173l-1.172-1.173h0Z" fill="var(--fg-color)" />
        </svg>
      </button>
      <p v-if="likes > 0">[{likes}]</p>
    </article>`,
    title,
    likes:0,
    likeAdded:false,
    async mounted() {
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


export {
  likes
};