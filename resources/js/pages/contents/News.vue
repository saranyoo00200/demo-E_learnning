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
                      <i class="fas fa-newspaper" style="font-size: 80px"></i>
                      ข่าวสารต่างๆ
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <section class="grid-news">
              <div class="container">
                <div class="row">
                  <div class="container">
                    <div class="classic-posts">
                      <div class="row">
                        <div
                          class="col-md-4"
                          v-for="news in News"
                          :key="news.id"
                        >
                          <div class="slider owl-carousel mt-2">
                            <div class="card" style="cursor: default">
                              <div class="img">
                                <img :src="news.news_photo" alt="" />
                              </div>
                              <div class="content" style="cursor: default">
                                <ul>
                                  <li>
                                    Posted:
                                    <em>{{ format_date(news.created_at) }}</em>
                                  </li>
                                  <!-- <li>Comments: <em>2</em></li> -->
                                </ul>
                                <div><hr /></div>
                                <div class="title">{{ news.news_title }}</div>
                                <p
                                  :inner-html.prop="
                                    news.news_detail | truncate(250)
                                  "
                                ></p>
                                <div class="btn">
                                  <router-link
                                    :to="{
                                      name: 'news_id',
                                      params: { id: news.news_id },
                                    }"
                                    ><a class="btn btn-info text-white">
                                      อ่านเพิ่มเติม
                                      <i
                                        class="fas fa-arrow-circle-right"
                                      ></i></a
                                  ></router-link>
                                </div>
                              </div>
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
                                        href="#"
                                        @click="
                                          DataNews(pagination.path_page + n)
                                        "
                                        class="one"
                                        style="
                                          cursor: pointer;
                                          text-decoration: none;
                                        "
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
                                          DataNews(
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
                                          DataNews(
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
                    </div>
                  </div>
                </div>
                <a
                  class="btn btn-info mt-5"
                  type="button"
                  @click="$router.go(-1)"
                  style="text-decoration: none; color: white; float: right"
                  ><i class="fas fa-chevron-left"></i> กลับ
                </a>
              </div>
            </section>
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
import moment from "moment";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "news",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      News: [],
      RecentNews: [],
      pagination: {},
      loading: true,
    };
  },
  mounted() {
    this.DataNews();
    this.DataNews_id();
  },

  methods: {
    DataNews(page) {
      page = page || "/api/news_all";
      fetch(page)
        .then((res) => res.json())
        .then((res) => {
          this.News = res.data;
          this.pagination = {
            current_page: res.current_page,
            last_page: res.last_page,
            path_page: res.path + "?page=",
            prev_link: res.current_page - 1,
            next_link: res.current_page + 1,
          };
          this.loading = false;
          //   console.log("Prev = " + this.pagination.prev_link);
          //   console.log("Current = " + res.current_page);
          //   console.log("Next = " + this.pagination.next_link);
          //   console.log("Last = " + this.pagination.last_page);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    DataNews_id() {
      axios
        .get("/api/news_id")
        .then((res) => {
          this.RecentNews = res.data;
          //   console.log(this.RecentNews);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    format_date(value) {
      if (value) {
        moment.locale("th");
        return moment(String(value)).add(543, "years").format("DD/MMM/YYYY");
      }
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
  font-size: 18px;
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

hr {
  width: 100%;
  margin-left: auto;
  margin-right: auto;
}

.backbt {
  background: #a12c2f;
  color: #fff;
}
.backbt:hover {
  background: #d43a3f;
}
</style>
