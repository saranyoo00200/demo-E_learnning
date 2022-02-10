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
      <div v-else>
        <div v-if="this.sync_id != ''" class="container-fluid">
          <div class="mt-5">
            <div class="bg-white p-3 shadow-lg text-center">
              <h1 class="text-center">คลิกเพื่อเรียนออนไลน์</h1>
              <span
                ><p>
                  Link เข้าสู่การเรียน:
                  <a :href="learningOnline.synch_url" target="bang">{{
                    learningOnline.synch_url
                  }}</a>
                </p></span
              >
              <span
                ><p>Password: {{ learningOnline.synch_password }}</p></span
              >
            </div>
            <div class="my-3">
              <a
                v-show="this.learningOnline.synch_openpost == 1"
                class="btn btn-danger mb-4"
                style="float: right"
                @click="redirectPageToLesson(), moveUp()"
                >แบบทดสอบหลังเรียน</a
              >
              <a
                class="btn backbt"
                type="button"
                @click="$router.go(-1)"
                style="text-decoration: none; color: white; float: right"
                ><i class="fas fa-chevron-left"></i> กลับ
              </a>
            </div>
          </div>
        </div>
        <div v-else class="flex justify-center items-center">
          <div class="p-4">
            <!-- <h1 class="font-bold text-3xl text-center text-indigo-700">บทเรียน</h1> -->
            <div class="bg-white p-12 shadow-lg mt-3">
              <div v-for="post in posts" :key="post.id" id="lesson">
                <div class="container col-10">
                  <h1 class="text-center my-3 mb-4 mt-4">
                    บทเรียนที่ <b>{{ count }}</b> {{ post.lessonName }}
                  </h1>
                  <div class="title-img text-center">
                    <img
                      class="mb-4"
                      :src="post.image"
                      alt=""
                      width="100%"
                      height=""
                    />
                  </div>
                  <div class="p-3" style="text-align: center">
                    <p
                      class="mb-4"
                      v-html="post.title"
                      style="text-align: left"
                    ></p>
                    <video
                      class="shadow"
                      :src="post.vdo"
                      :poster="post.image"
                      width="75%"
                      controls
                    ></video>
                  </div>
                </div>
              </div>
              <div class="row p-3">
                <div class="col-md-12">
                  <div class="pagination-navigation">
                    <div class="row">
                      <div class="col-md-6 col-xs-6">
                        <div class="pagination pagination-sm">
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
                                href="#"
                                @click="DataLesson(pagination.path_page + n)"
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
                              <a href="#" v-if="pagination.current_page == 1"
                                ><i class="fa fa-arrow-left"></i
                              ></a>
                              <a
                                v-else
                                href="#"
                                @click="
                                  DataLesson(
                                    pagination.path_page + pagination.prev_link
                                  )
                                "
                                ><i class="fa fa-arrow-left"></i
                              ></a>
                            </li>
                            <li class="page-item">
                              <a
                                href="#"
                                v-if="
                                  pagination.current_page ==
                                  pagination.last_page
                                "
                                ><i class="fa fa-arrow-right"></i
                              ></a>
                              <a
                                v-else
                                href="#"
                                @click="
                                  DataLesson(
                                    pagination.path_page + pagination.next_link
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
            </div>
            <div class="my-3">
              <router-link
                v-show="this.checkRedirect == 1"
                @click.native="moveUp()"
                class="btn btn-danger mb-4"
                style="float: left"
                tage="button"
                :to="{ name: 'lessons' }"
              >
                กลับสู่หน้าหลัก
              </router-link>
              <button
                v-show="this.checkRedirect == 0"
                class="btn btn-primary mb-4"
                style="
                  float: left;
                  box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px,
                    rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
                  margin-right: 10px;
                "
                @click="redirectPageToLesson(), moveUp()"
              >
                แบบทดสอบหลังเรียน
              </button>
              <!-- <a
                class="btn btn-info text-white"
                type="button"
                @click="$router.go(-1)"
                style="float: right"
                ><i class="fas fa-chevron-left"></i> กลับ
              </a> -->
            </div>
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
import axios from "axios";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "lessons",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      count: "",
      posts: {},
      pagination: {},
      sync_id: "",
      checkRedirect: 0,
      loading: true,
      learningOnline: {},
    };
  },
  mounted() {
    if (this.$store.state.token == "") {
      this.loading = false;
      this.$router.push("/learning/login");
    } else {
      this.checkRedirectPage();
      this.DataLesson();
    }
  },
  methods: {
    checkRedirectPage() {
      axios
        .get("/api/posttest_quiz/" + this.$route.params.id)
        .then((res) => {
          this.countQuizPost = res.data.length;
        })
        .catch((err) => {
          this.error = "Error!!";
        });
      axios
        .get(
          "/api/checkRedirectPage2/" +
            this.$route.params.id +
            "/" +
            this.$store.state.user_id
        )
        .then((res) => {
          if (res.data != "") {
            this.x = (70 * this.countQuizPost) / 100;
            if (res.data[0].score >= this.x) {
              this.checkRedirect++;
            }
          }
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    moveUp() {
      window.scrollTo(0, 0);
    },
    DataLesson(page) {
      page = page || "/api/lesson_learning/" + this.$route.params.id;
      fetch(page)
        .then((res) => res.json())
        .then((res) => {
          //   this.count = res.data.length;
          this.posts = res.data;
          this.count = res.current_page;
          this.pagination = {
            current_page: res.current_page,
            last_page: res.last_page,
            path_page: res.path + "?page=",
            prev_link: res.current_page - 1,
            next_link: res.current_page + 1,
          };

          //หาค่า sync_id เพื่อกำหนด if button
          axios
            .get("/api/data_add_lessons/" + this.$route.params.id)
            .then((res) => {
              this.sync_id = res.data;
              this.learningOnline = [];
              for (let i = 0; i < res.data.length; i++) {
                this.learningOnline = {
                  synch_url: res.data[i].synch_url,
                  synch_password: res.data[i].synch_password,
                  synch_openpost: res.data[i].synch_openpost,
                };
              }
              //   console.log(res.data[0].synch_url);
              this.loading = false;
            })
            .catch((error) => {
              console.log(error);
            });
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    redirectPageToLesson() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };

      let formData = new FormData();
      formData.append("subject_id", this.$route.params.id);
      formData.append("user_id", this.$store.state.user_id);

      axios
        .post("/api/redirect_save/lesson_progress", formData, config)
        .then((res) => {})
        .catch((err) => {
          this.error = "Error!!";
        });
      this.$router.push({
        name: "posttest",
        params: { id: this.$route.params.id },
      });
    },
  },
};
</script>

<style>
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
#content {
  margin-top: 8%;
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
.backbt {
  background: #a12c2f;
  color: #fff;
}
.backbt:hover {
  background: #d43a3f;
}

@media (min-width: 640px) {
}

@media (min-width: 768px) {
}

@media (min-width: 1024px) {
}

@media (min-width: 1280px) {
}

@media (min-width: 1536px) {
}
</style>
