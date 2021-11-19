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
        <h2 style="text-align: center">รายวิชาล่าสุด</h2>
        <hr />

        <div class="row">
          <div class="col-md-3 mb-4" v-for="post in posts" :key="post.id">
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
                  :to="{
                    name: 'course_id',
                    params: { id: post.id },
                  }"
                  ><a class="btn btn-info mt-2 text-white">ดูรายละเอียด</a></router-link
                >
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="row">

          <div class="col-md-4 owl-carousel mt-3 slider">


            <div v-for="post in posts" :key="post.id" class="card">
              <div class="img">
                <img :src="post.image" alt="" />
              </div>
              <div class="content">
                <div class="title">{{ post.subjectName }}</div>

                <div class="sub-title">
                  <span class="dot-1"></span> {{ post.subjectType }}
                </div>
                <p :inner-html.prop="post.title | truncate(150)"></p>
                <div class="btn">
                  <router-link
                    :to="{
                      name: 'course_id',
                      params: { id: post.id },
                    }"
                    ><button>View more</button></router-link
                  >
                </div>
              </div>
            </div>
          </div>
        </div> -->
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
        .get("/api/subject_home")
        .then((res) => {
          this.posts = res.data.data;
          this.loading = false;
          //   console.log(res.data.data);
        })
        .catch((err) => {
          this.error = "Error!!";
        });
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

<style scoped>
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
/* .slider {
  max-width: 100%;
  display: flex;
}
.slider .card {
  flex: 1;
  margin: 0 10px;
  background: #fff;
}
.slider .card .img {
  height: 200px;
  width: 100%;
}
.slider .card .img img {
  height: 100%;
  width: 100%;
  object-fit: cover;
}
.slider .card .content {
  padding: 10px 20px;
}
.card .content .title {
  font-size: 25px;
  font-weight: 600;
}
.card .content .sub-title {
  font-size: 20px;
  font-weight: 600;
  color: #e74c3c;
  line-height: 20px;
}
.card .content p {
  text-align: justify;
  margin: 10px 0;
}
.card .content .btn button {
  background: #f36656;
  color: #fff;
  border: none;
  outline: none;
  font-size: 17px;
  padding: 5px 8px;
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}
.card .content .btn button:hover {
  transform: scale(0.9);
} */
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
