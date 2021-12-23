<template>
  <div id="main">
    <div id="header">
      <HeaderComponent />
    </div>

    <div id="content">
      <div
        id="load"
        v-if="this.loading"
        class="d-flex align-items-center"
      ></div>
      <div v-else>
        <div
          id="carouselExampleIndicators"
          class="carousel slide"
          data-ride="carousel"
        >
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img
                src="/assets/frontend/images/content_banner/content_banner_2.png"
                class="d-block w-100"
                alt=""
              />
            </div>
            <div class="carousel-item">
              <img
                src="/assets/frontend/images/content_banner/content_banner_3.png"
                class="d-block w-100"
                alt=""
              />
            </div>
            <div class="carousel-item">
              <img
                src="/assets/frontend/images/content_banner/content_banner.png"
                class="d-block w-100"
                alt=""
              />
            </div>
          </div>
          <a
            class="carousel-control-prev"
            href="#carouselExampleIndicators"
            role="button"
            data-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a
            class="carousel-control-next"
            href="#carouselExampleIndicators"
            role="button"
            data-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <h1
          class="mb-5"
          style="text-align: center; padding-top: 50px; padding-bottom: 10px"
        >
          หมวดหมู่รายวิชา
        </h1>
        <div class="container">
          <div class="row">
            <router-link
              v-for="category in categorys"
              :key="category.category_id"
              class="col-md-3 mb-4 logo"
              @click.native="moveUp()"
              style="text-decoration: none; color: black"
              :to="{
                name: 'content_categorie',
                params: { id: category.subjectType },
              }"
            >
              <img :src="category.image" alt="" class="course" />
              <span class="title">{{ category.category_name }}</span>
            </router-link>
          </div>
          <h2
            class=""
            style="text-align: center; padding-top: 50px; padding-bottom: 20px"
          >
            รายวิชาล่าสุด
          </h2>
          <div class="container-fluid">
            <div
              id="carouselExampleControls"
              class="carousel slide"
              data-ride="carousel"
            >
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="slider owl-carousel">
                    <div
                      v-for="post in posts.slice(0, 3)"
                      :key="post.id"
                      class="card"
                    >
                      <div class="img">
                        <img :src="post.image" alt="" />
                      </div>
                      <div class="content">
                        <div class="title">{{ post.subjectName }}</div>

                        <div class="sub-title">
                          <span class="dot-1"></span> {{ post.category_name }}
                          <hr />
                        </div>
                        <p
                          :inner-html.prop="post.title | truncate(150)"
                          style="height: 8rem"
                        ></p>
                        <div class="btn">
                          <router-link
                            @click.native="moveUp()"
                            :to="{
                              name: 'course_id',
                              params: { id: post.id },
                            }"
                            ><a class="btn btn-info text-white"
                              >ดูรายละเอียด</a
                            ></router-link
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="vl mt-5">
              <h2>เกี่ยวกับเรา</h2>
              <span style="font-style:italic">about us</span>
            </div> -->

            <router-link
              class="btn btn-info my-5"
              @click.native="moveUp()"
              style="float: right; font-size: 15px; text-decoration: none"
              to="/lessonupdate"
              >ดูเพิ่มเติม <i class="fas fa-search"></i
            ></router-link>
          </div>
        </div>
      </div>
    </div>
    <div id="footer">
      <FooterComponent />
    </div>
  </div>
</template>

<script>
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "contents",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      loading: true,
      posts: [],
      categorys: [],
    };
  },
  mounted() {
    this.DataCategory();
    this.DataPost();
  },
  methods: {
    DataPost() {
      axios
        .get("/api/subject_home")
        .then((res) => {
          this.posts = res.data.data;
          this.loading = false;
          // console.log(res.data.data);
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    DataCategory() {
      axios
        .get("/api/subject_category")
        .then((res) => {
          this.categorys = res.data;
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

<style scoped>
/* ##### >> https://fonts.google.com/specimen/Sarabun?query=sara#standard-styles */
@import url("https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap");
h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "Sarabun", sans-serif;
}
.home-head {
  padding-top: 0px;
}
#content {
  margin-top: 5%;
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

.logo {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.logo img {
  margin-bottom: 0.5rem;
  width: 150px;
  height: 150px;
  border-radius: 10px;
  border: 3.5px solid rgb(240, 240, 240);
}
.logo .title:hover {
  text-decoration: underline;
}
.course:hover {
  box-shadow: rgba(50, 50, 93, 0.25) 0px 5px 15px -1px,
    rgba(0, 0, 0, 0.3) 0px 3px 5px -1px;
}

/* ======================
  logo underline effect
======================  */
.title {
  font-family: "Sarabun", sans-serif, cursive;
  position: relative;
}
.title::after {
  position: absolute;
  content: "";
  width: 0%;
  height: 3px;
  background-color: rgb(200, 200, 200);
  left: 0%;
  bottom: -5px;
  transition: all 0.3s ease-in-out;
}

/* ======================
      Slide Cards
======================  */

.slider {
  max-width: 1100px;
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
  font-size: 20px;
}
.card .content .sub-title {
  font-size: 16px;
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
}
.card:hover {
  /* background-color: #fff8fc ; */
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px,
    rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}
.vl {
  border-left: 8px solid #d43a3f;
  height: 65px;
  padding-left: 0.5rem;
}
.bteffect {
  background: #a12c2f;
  color: #fff;
}
.bteffect:hover {
  background: #d43a3f;
}
.dot-1 {
  height: 18px;
  width: 18px;
  border-radius: 50px;
  background-color: #add8e6;
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
@include media-breakpoint-up(sm) {
  .carousel-item .slider .card {
    display: block;
  }
}
@include media-breakpoint-up(md) {
}
@include media-breakpoint-up(lg) {
}
@include media-breakpoint-up(xl) {
}
@include media-breakpoint-up(xxl) {
}
</style>
