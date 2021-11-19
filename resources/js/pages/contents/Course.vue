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
        style="padding-top: 10em"
      ></div>
      <div v-else class="sidebar-menu-container" id="sidebar-menu-container">
        <div class="sidebar-menu-push">
          <div class="sidebar-menu-overlay"></div>
          <div class="sidebar-menu-inner">
            <div class="page-heading">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="text-white" style="font-size: 90px">
                      <i class="fas fa-book-open" style="font-size: 80px"></i>
                      คอร์สเรียนของเรา
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <section id="nextAndPrev" class="courses-grid" style="padding-top: 0px">
              <div class="container">
                <h2
                  class=""
                  style="
                    text-align: center;
                    padding-top: 40px;
                    padding-bottom: 20px;
                  "
                >
                  รายชื่อวิชา
                </h2>
                <hr />
                <select
                  class="form-select mb-2"
                  aria-label="Default select example"
                  @change="clickOptions()"
                  v-model="categorysOptions"
                >
                  <option selected disabled>*เลือกรายชื่อวิชา*</option>
                  <option value="">ทั้งหมด</option>
                  <option
                    v-for="(category, index) in categorys"
                    :key="index"
                    :value="category.subjectType"
                  >
                    {{ category.category_name }}
                  </option>
                </select>
                <div class="row">
                  <div
                    class="col-md-3 mb-3"
                    v-for="post in posts"
                    :key="post.id"
                  >
                    <div class="card">
                      <img class="card-img-top" :src="post.image" alt="" />
                      <div class="card-body">
                        <div class="card-title">{{ post.subjectName }}</div>
                        <div class="sub-title">
                          <span class="dot-3"></span> {{ post.category_name }}
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
                          ><a class="btn btn-info mt-2 text-white"
                            >ดูรายละเอียด</a
                          ></router-link
                        >
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="pagination-navigation">
                      <div class="row">
                        <div class="col-md-6 col-xs-6">
                          <div class="pagination">
                            <ul>
                              <li
                                v-for="n in pagination.last_page"
                                :key="n"
                                :class="{
                                  active: pagination.current_page == n,
                                }"
                                class="page-item"
                              >
                                <a
                                  href="#nextAndPrev"
                                  @click="DataPost(pagination.path_page + n)"
                                  class="one"
                                  style="cursor: pointer"
                                >
                                  {{ n }}</a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                          <div class="navigation">
                            <ul>
                              <li
                                class="page-item"
                                style="cursor: pointer"
                                :class="{
                                  disabled:
                                    pagination.current_page ==
                                    pagination.last_page,
                                }"
                              >
                                <a v-if="pagination.current_page == 1"
                                  ><i class="fa fa-arrow-left"></i
                                ></a>
                                <a
                                  v-else
                                  href="#nextAndPrev"
                                  @click="
                                    DataPost(
                                      pagination.path_page +
                                        pagination.prev_link
                                    )
                                  "
                                  ><i class="fa fa-arrow-left"></i
                                ></a>
                              </li>
                              <li class="page-item">
                                <a
                                  v-if="
                                    pagination.current_page ==
                                    pagination.last_page
                                  "
                                  href="#nextAndPrev"
                                  ><i class="fa fa-arrow-right"></i
                                ></a>
                                <a
                                  v-else
                                  href="#nextAndPrev"
                                  @click="
                                    DataPost(
                                      pagination.path_page +
                                        pagination.next_link
                                    )
                                  "
                                  ><i class="fa fa-arrow-right"></i
                                ></a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <a
                  class="btn btn-info my-5"
                  type="button"
                  @click="$router.go(-1)"
                  style="text-decoration: none; color: white; float: right"
                  ><i class="fas fa-chevron-left"></i> Back
                </a>
              </div>
            </section>
            <a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
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
// import axios from "axios";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "course",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      posts: {},
      pagination: {},
      loading: true,
      categorys: [],
      categorysOptions: "",
    };
  },
  mounted() {
    this.DataPost();
    this.DataCategory();
  },
  methods: {
    DataPost(page) {
      if (this.categorysOptions == "") {
        page = page || "/api/subject_learning";
        fetch(page)
          .then((res) => res.json())
          .then((res) => {
            this.posts = res.data;
            this.pagination = {
              current_page: res.current_page,
              last_page: res.last_page,
              path_page: res.path + "?page=",
              prev_link: res.current_page - 1,
              next_link: res.current_page + 1,
            };
            this.loading = false;
          })
          .catch((err) => {
            console.log(err);
          });
      } else {
        page = page || "/api/course_options_subject/" + this.categorysOptions;
        fetch(page)
          .then((res) => res.json())
          .then((res) => {
            this.posts = res.data;
            this.pagination = {
              current_page: res.current_page,
              last_page: res.last_page,
              path_page: res.path + "?page=",
              prev_link: res.current_page - 1,
              next_link: res.current_page + 1,
            };
            this.loading = false;
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
    clickOptions() {
      this.DataPost();
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
.one {
  text-decoration: none;
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
h1,
h2,
h3,
h4,
h5 {
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

.form-select {
  position: relative;
  background-color: #fafafa;
  padding: 6px 24px 6px 10px;
  border-radius: 4px;
  border-color: #dddddd;
}
.form-select :active,
.select-dropdown select:focus {
  outline: none;
  box-shadow: none;
}
.form-select:after {
  content: "";
  position: absolute;
  top: 50%;
  right: 8px;
  width: 0;
  height: 0;
  margin-top: -2px;
  border-top: 5px solid #aaa;
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
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
  background-color: #add8e6;
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
