<template>
  <div id="main">
    <div id="header">
      <HeaderComponent />
    </div>

    <div id="content">
      <div
        v-if="this.loading"
        id="load"
        class="d-flex align-items-center"
      ></div>
      <div v-else class="container">
        <h2 class="container mb-4" style="text-align: center">
          หมวดหมู่ วิชา{{ this.posts[0].category_name }}
        </h2>
        <hr />

        <div class="row">
          <div class="col-md-3" v-for="post in posts" :key="post.id">
            <div class="card">
              <img class="card-img-top" :src="post.image" alt="" />
              <div class="card-body">
                <div class="card-title">{{ post.subjectName }}</div>
                <div class="sub-title">
                  <span class="dot-2"></span> {{ post.category_name }}
                  <hr />
                </div>
                <p
                  :inner-html.prop="post.title | truncate(150)"
                  style="height: 7rem"
                ></p>
                <router-link
                  @click.native="moveUp()"
                  :to="{
                    name: 'course_id',
                    params: { id: post.id },
                  }"
                  ><a class="btn btn-info mt-2 text-white"
                    >ดูรายละเอียด</a
                  ></router-link
                >
              </div>
            </div>
          </div>
        </div>

        <a
          class="btn btn-info my-5"
          @click="$router.go(-1)"
          style="
            text-decoration: none;
            color: white;
            cursor: pointer;
            float: right;
          "
          ><i class="fas fa-chevron-left"></i> กลับ
        </a>
      </div>
    </div>

    <div id="footer">
      <FooterComponent />
    </div>
  </div>
</template>

<script>
import HeaderComponent from "../../components/HeaderComponent";
import FooterComponent from "../../components/FooterComponent";
export default {
  name: "lessonRecent",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      posts: [],
      loading: true,
    };
  },
  mounted() {
    this.DataPost();
  },
  methods: {
    DataPost() {
      axios
        .get("/api/content_category/" + this.$route.params.id)
        .then((res) => {
          this.posts = res.data;
          this.loading = false;
          //   console.log(res.data);
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    moveUp() {
      window.scrollTo(0, 0);
    },
  },
};

Vue.filter("truncate", function (value, length) {
  if (!value) return "";
  value = value.toString();
  if (value.length > length) {
    return value.substring(0, length) + "...";
  } else {
    return value;
  }
});
</script>

<style>
/* ##### >> https://fonts.google.com/specimen/Sarabun?query=sara#standard-styles */
@import url("https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap");
#content {
  margin-top: 9%;
}

#load {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url("https://cdn.discordapp.com/attachments/841562172697477130/901000684172877824/unnamed.gif")
    50% 50% no-repeat rgb(249, 249, 249);
  background-size: 100px;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "Sarabun", sans-serif;
}
.card-body .card-title {
  font-size: 20px;
  line-height: 0.5em;
}
.card-body .sub-title {
  font-size: 16px;
  color: #e74c3c;
}
.card-img-top {
  height: 200px;
  width: 100%;
}
.card-img-top img {
  height: 100%;
  width: 100%;
  object-fit: cover;
}
.card:hover {
  /* background-color: #fff8fc ; */
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px,
    rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}
.dot-1 {
  height: 18px;
  width: 18px;
  border-radius: 50px;
  background-color: #fe2929;
  display: inline-block;
}
.dot-2 {
  height: 18px;
  width: 18px;
  border-radius: 50px;
  background-color: #add8e6;
  display: inline-block;
}
.dot-3 {
  height: 18px;
  width: 18px;
  border-radius: 50px;
  background-color: #ffa500;
  display: inline-block;
}
.dot-4 {
  height: 18px;
  width: 18px;
  border-radius: 50px;
  background-color: #ff00ff;
  display: inline-block;
}
.backbt {
  background: #a12c2f;
  color: #fff;
}
.backbt:hover {
  background: #d43a3f;
}
</style>
