
const blog = ( {posts} ) => {

  const allCategories = Array.from( new Set( posts.map( p=>p.tags).flat().filter( c => c !== "post" && c !== "published") ) );

  return {
    posts,
    initialized:false,
    chosenCategories:[],
    allCategories,
    mounted() {
      this.initialized = true;
    },
    get filteredPosts() {
      if(this.chosenCategories.length === 0) {
        return this.posts;
      }

      return this.posts.filter( p => p.tags.some( t => this.chosenCategories.includes(t) ) );
    }
  }
}

export {
  blog
};

