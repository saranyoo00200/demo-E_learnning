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
            <div id="search">
              <button type="button" class="close">×</button>
              <form>
                <input
                  type="search"
                  value=""
                  placeholder="type keyword(s) here"
                />
                <button type="submit" class="btn btn-primary">
                  <span>Search</span>
                </button>
              </form>
            </div>

            <div class="page-heading">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="text-white" style="font-size: 90px">
                      <i
                        class="fas fa-chalkboard-teacher"
                        style="font-size: 80px"
                      ></i>
                      อาจารย์ผู้สอน
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <section class="teachers-page">
              <div class="container">
                <div class="row">
                  <router-link
                    v-for="Data in DataTeachers"
                    :key="Data.id"
                    class="col-md-3"
                    @click.native="moveUp()"
                    style="text-decoration: none; color: black"
                    :to="{
                      name: 'teacher_id',
                      params: { id: Data.id },
                    }"
                  >
                    <div class="teacher-item">
                      <img :src="Data.user_photo" height="275px" alt="" />
                      <div class="down-content">
                        <a href="#"
                          ><h4>{{ Data.name }}</h4></a
                        >
                        <span><b>อาจารย์</b></span>
                        <hr />
                      </div>
                    </div>
                  </router-link>
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
                                  href="#"
                                  @click="DataTeacher(pagination.path_page + n)"
                                  class="one"
                                  style="cursor: pointer; text-decoration: none"
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
                                  href="#"
                                  @click="
                                    DataTeacher(
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
                                  ><i class="fa fa-arrow-right"></i
                                ></a>
                                <a
                                  v-else
                                  href="#"
                                  @click="
                                    DataTeacher(
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
                  class="btn btn-info mt-4"
                  type="button"
                  @click="$router.go(-1)"
                  style="text-decoration: none; color: white; float: right"
                  ><i class="fas fa-chevron-left"></i> กลับ
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

<script scope>
import axios from "axios";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "teacher",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      DataTeachers: [],
      pagination: {},
      loading: true,
    };
  },
  mounted() {
    this.DataTeacher();
  },
  methods: {
    DataTeacher(page) {
      page = page || "/api/teacher_contact";
      fetch(page)
        .then((res) => res.json())
        .then((res) => {
          this.DataTeachers = res.data;
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
    },
    moveUp() {
      window.scrollTo(0, 0);
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
.teacher-item:hover {
  /* background-color: #fff8fc ; */
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px,
    rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}
.backbt {
  background: #a12c2f;
  color: #fff;
}
.backbt:hover {
  background: #d43a3f;
}
</style>
