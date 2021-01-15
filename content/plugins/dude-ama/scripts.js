/* eslint-disable-next-line */
const api = axios.create({
  baseURL: `${window.dudeAmaApiURL}`,
});

// Erase previous form submit to prevent duplicate submits on refresh
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

const preLoaded = document.querySelectorAll('.pre-loaded .ama-item');
const stopTheMadness = typeof window.stopTheMadness !== 'undefined' ?  window.stopTheMadness : false;
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
      sendingQuestion: false,
      loadingLikes: false,
      updateRate: 20000,
      postIntervalRunner: null,
      question: '',
      questionSent: false,
      error: false,
      stopTheMadness,
    };
  },
  mounted() {
    this.startAutoRefresh(this.updateRate);
    if (!stopTheMadness) {
      setInterval(() => {
        this.getDrafts();
      }, 5000);
    }
  },
  methods: {
    getPosts(perPage) {
      // Throttle requests
      if (this.loadingPosts) {
        return;
      }
      this.loadingPosts = true;
      const queryString = this.timeStamp ? `?after=${this.timeStamp}&per_page=${perPage}&order=asc` : '';
      // Get questions
      api
        .get(`/wp-json/wp/v2/ama/${queryString}`)
        .then((response) => {
          if (response.data.length) {
            // Extract data and reverse;
            const newPosts = [...response.data];
            this.timeStamp = newPosts[newPosts.length - 1].date;
            newPosts.forEach((data) => {
              // Add to start of array
              // eslint-disable-next-line no-param-reassign
              data.state = 'loaded';

              setTimeout((id) => {
                const currentPost = this.posts.find((post) => post.id === id);
                currentPost.state = 'show';
              }, 2000, data.id);

              this.posts.unshift(data);
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
      if (this.loadingDrafts) {
        return;
      }
      this.loadingDrafts = true;
      api
        .get('/wp-json/ama/v1/drafts')
        .then((response) => {
          this.drafts = parseInt(response.data, 10);
          this.loadingDrafts = false;
        })
        .catch((error) => {
          // eslint-disable-next-line no-console
          console.log(error);
          this.loadingDrafts = false;
        });
    },
    startAutoRefresh(rate) {
      if (stopTheMadness) {
        return;
      }
      const parsedRate = parseInt(rate, 10);
      this.postIntervalRunner = setInterval(() => {
        this.getPosts(1);
      }, parsedRate);
    },
    stopAutoRefresh() {
      clearInterval(this.postIntervalRunner);
    },
    changeUpdateRate(rate) {
      const parsedRate = parseInt(rate, 10);
      this.stopAutoRefresh();
      if (parsedRate === 0) {
        return;
      }
      this.updateRate = parsedRate;
      this.startAutoRefresh(parsedRate);
    },
    submitQuestion(event) {
      event.preventDefault();
      if (this.sendingQuestion) {
        return;
      }
      this.sendingQuestion = true;
      const formData = {
        question: this.question,
      };
      api.post('wp-json/dude-ama/v1/create-question', formData)
        .then((response) => {
          this.error = false;
          this.questionSent = true;
          this.sendingQuestion = false;
          this.getDrafts();
        })
        .catch((error) => {
          // eslint-disable-next-line no-console
          console.log(error);
          this.error = true;
          this.questionSent = true;
          this.sendingQuestion = false;
        });
    },
    resetForm() {
      this.question = '';
      this.questionSent = false;
    },
    getLikes() {
      if (this.loadingLikes) {
        return;
      }
      this.loadingLikes = true;
      api
        .get('/wp-json/ama/v1/likes')
        .then((response) => {
          if (typeof response.data === 'object') {
            // eslint-disable-next-line no-plusplus
            for (let id = 0; id < response.data.length; id++) {
              const likeAmount = parseInt(response.data[id], 10);
              if (this.posts[id]) {
                this.posts[id].likes = likeAmount;
              }
            }
          }
          this.loadingLikes = false;
        })
        .catch((error) => {
          // eslint-disable-next-line no-console
          console.log(error);
          this.loadingLikes = false;
        });
    },
  },
};

// eslint-disable-next-line no-undef
const dudeAma = Vue.createApp(Ama);

dudeAma.component('likes', {
  props: ['count', 'id'],
  data() {
    const currentCount = this.count;
    const disableLike = window.localStorage.getItem(`dude-ama-liked-${this.id}`);
    return {
      currentCount,
      disableLike,
    };
  },
  template: `
    <div class="likes">
      <button type="button" class="button" v-on:click="submitLike()" :disabled="disableLike">
        <svg viewBox="0 -28 512.001 512" width="32" height="32" xmlns="http://www.w3.org/2000/svg"><path d="M256 455.516c-7.29 0-14.316-2.641-19.793-7.438-20.684-18.086-40.625-35.082-58.219-50.074l-.09-.078c-51.582-43.957-96.125-81.918-127.117-119.313C16.137 236.81 0 197.172 0 153.871c0-42.07 14.426-80.883 40.617-109.293C67.121 15.832 103.488 0 143.031 0c29.555 0 56.621 9.344 80.446 27.77C235.5 37.07 246.398 48.453 256 61.73c9.605-13.277 20.5-24.66 32.527-33.96C312.352 9.344 339.418 0 368.973 0c39.539 0 75.91 15.832 102.414 44.578C497.578 72.988 512 111.801 512 153.871c0 43.3-16.133 82.938-50.777 124.738-30.993 37.399-75.532 75.356-127.106 119.309-17.625 15.016-37.597 32.039-58.328 50.168a30.046 30.046 0 01-19.789 7.43zM143.031 29.992c-31.066 0-59.605 12.399-80.367 34.914-21.07 22.856-32.676 54.45-32.676 88.965 0 36.418 13.535 68.988 43.883 105.606 29.332 35.394 72.961 72.574 123.477 115.625l.093.078c17.66 15.05 37.68 32.113 58.516 50.332 20.961-18.254 41.012-35.344 58.707-50.418 50.512-43.051 94.137-80.223 123.469-115.617 30.344-36.618 43.879-69.188 43.879-105.606 0-34.516-11.606-66.11-32.676-88.965-20.758-22.515-49.3-34.914-80.363-34.914-22.758 0-43.653 7.235-62.102 21.5-16.441 12.719-27.894 28.797-34.61 40.047-3.452 5.785-9.53 9.238-16.261 9.238s-12.809-3.453-16.262-9.238c-6.71-11.25-18.164-27.328-34.61-40.047-18.448-14.265-39.343-21.5-62.097-21.5zm0 0"/></svg>
      </button>
      <span v-if="currentCount">{{currentCount}}</span>
    </div>`,
  methods: {
    submitLike() {
      if (this.disableLike) {
        return;
      }
      this.disableLike = true;
      const formData = { id: this.id };
      api.post('wp-json/dude-ama/v1/add-like', formData)
        .then(() => {
          this.currentCount += 1;
          window.localStorage.setItem(`dude-ama-liked-${this.id}`, true);
        })
        .catch((error) => {
          // eslint-disable-next-line no-console
          console.log(error);
          this.disableLike = false;
        });
    },
  },
});

dudeAma.mount('#dude-ama');
