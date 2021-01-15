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
        <svg aria-hidden="true" width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path class="outside" d="M1664 596q0-81-21.5-143t-55-98.5-81.5-59.5-94-31-98-8-112 25.5-110.5 64-86.5 72-60 61.5q-18 22-49 22t-49-22q-24-28-60-61.5t-86.5-72-110.5-64-112-25.5-98 8-94 31-81.5 59.5-55 98.5-21.5 143q0 168 187 355l581 560 580-559q188-188 188-356zm128 0q0 221-229 450l-623 600q-18 18-44 18t-44-18l-624-602q-10-8-27.5-26t-55.5-65.5-68-97.5-53.5-121-23.5-138q0-220 127-344t351-124q62 0 126.5 21.5t120 58 95.5 68.5 76 68q36-36 76-68t95.5-68.5 120-58 126.5-21.5q224 0 351 124t127 344z"/><path class="inside" d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26t-55.5-65.5-68-97.5-53.5-121-23.5-138q0-220 127-344t351-124q62 0 126.5 21.5t120 58 95.5 68.5 76 68q36-36 76-68t95.5-68.5 120-58 126.5-21.5q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z" /></svg><span class="label">Tykätty</span>
      </button>
      <span v-if="currentCount">{{currentCount}}</span> <span class="countlabel">kertaa</span>
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
