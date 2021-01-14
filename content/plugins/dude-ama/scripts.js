/* eslint-disable-next-line */
const api = axios.create({
  baseURL: `${window.dudeAmaApiURL}`,
});

const preLoaded = document.querySelectorAll('.pre-loaded .ama-item');
const lastItem = preLoaded.length ? preLoaded[0].querySelector('.inner') : false;
const timeStamp = lastItem ? lastItem.dataset.timestamp : false;
const drafts = typeof window.amaDrafts !== 'undefined' ? window.amaDrafts : 0;

const Ama = {
  data() {
    return {
      posts: [],
      drafts,
      timeStamp,
      loadingPosts: false,
      loadingDrafts: false,
    };
  },
  mounted() {
    setInterval(() => {
      if (!this.loadingPosts) {
        this.getPosts();
      }
    }, 15000);
    setInterval(() => {
      if (!this.loadingDrafts) {
        this.getDrafts();
      }
    }, 5000);
  },
  methods: {
    getPosts() {
      this.loadingPosts = true;
      const queryString = this.timeStamp ? `?after=${this.timeStamp}&per_page=1&order=asc` : '';
      // Get questions
      api
        .get(`/wp-json/wp/v2/ama/${queryString}`)
        .then((response) => {
          if (response.data.length) {
            this.timeStamp = response.data[0].date;
            // Extract data and reverse;
            const newPosts = [...response.data];
            newPosts.reverse();

            newPosts.forEach((data) => {
              // Add to start of array
              // eslint-disable-next-line no-param-reassign
              data.state = 'loaded';
              this.posts.unshift(data);
              // eslint-disable-next-line no-return-assign
              setTimeout(() => this.posts[0].state = 'show', 200);
            });
          }
          this.loadingPosts = false;
        })
        .catch((error) => {
          // eslint-disable-next-line no-console
          console.log(error);
          this.loadingPosts = false;
        });
    },
    getDrafts() {
      this.loadingDrafts = true;
      api
        .get('/wp-json/ama/v1/drafts')
        .then((response) => {
          if (response.data !== this.drafts) {
            this.getPosts();
          }
          this.drafts = response.data;
          this.loadingDrafts = false;
        })
        .catch((error) => {
          // eslint-disable-next-line no-console
          console.log(error);
          this.loadingDrafts = false;
        });
    },
  },
};

// eslint-disable-next-line no-undef
Vue.createApp(Ama).mount('#dude-ama');
