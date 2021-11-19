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
      <div v-else class="sidebar-menu-container" id="sidebar-menu-container">
        <div class="sidebar-menu-push">
          <!-- <div class="sidebar-menu-overlay"></div> -->
          <div class="sidebar-menu-inner">
            <!-- <div class="page-heading">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="text-white" style="font-size:90px;"><i class="fas fa-newspaper" style="font-size:80px"></i> ข่าวสารต่างๆ</div>
                    <span
                      >Salvia next level crucifix pickled heirloom synth</span
                    >
                  </div>
                </div>
              </div>
            </div> -->

            <section class="grid-news">
              <div class="container">
                <div class="row">
                  <div class="classic-posts">
                    <div class="mb-4" style="text-align: center">
                      <h3>{{ News.news_title }}</h3>
                    </div>
                    <div class="text-center mb-4">
                      <span
                        ><img
                          class="rounded border border-dark mb-4"
                          :src="News.news_photo"
                          width="500px"
                          height="300px"
                          alt=""
                      /></span>
                    </div>
                    <div class="mb-5">
                      <p
                        style="text-indent: 50px"
                        :inner-html.prop="News.news_detail"
                      ></p>
                    </div>
                    <div>
                      <p>
                        Post: <span>{{ format_date(News.created_at) }}</span>
                      </p>
                    </div>
                  </div>
                  <!-- <div class="col-md-4">
                    <div class="side-bar">
                      <div class="search-box">
                        <input
                          type="text"
                          class="search"
                          name="s"
                          placeholder="Search..."
                          value=""
                        />
                      </div>
                      <div class="categories">
                        <div class="widget-heading">
                          <h4>Categories</h4>
                        </div>
                        <ul>
                          <li>
                            <a href="#"
                              ><i class="fa fa-angle-right"></i>Design</a
                            >
                          </li>
                          <li>
                            <a href="#"
                              ><i class="fa fa-angle-right"></i>International</a
                            >
                          </li>
                          <li>
                            <a href="#"
                              ><i class="fa fa-angle-right"></i>Learning</a
                            >
                          </li>
                          <li>
                            <a href="#"
                              ><i class="fa fa-angle-right"></i>Read</a
                            >
                          </li>
                          <li>
                            <a href="#"
                              ><i class="fa fa-angle-right"></i>Education</a
                            >
                          </li>
                          <li>
                            <a href="#"
                              ><i class="fa fa-angle-right"></i>Finance</a
                            >
                          </li>
                        </ul>
                      </div>
                      <div class="recent-news">
                        <div class="widget-heading">
                          <h4>Recent News</h4>
                        </div>
                        <ul>
                          <router-link
                            v-for="news in RecentNews.slice(0, 2)"
                            :key="news.news_id"
                            :to="{
                              name: 'news_id',
                              params: { id: news.news_id },
                            }"
                            @click.native="$router.go()"
                          >
                            <li>
                              <a href=""
                                ><img
                                  :src="news.news_photo"
                                  width="70px"
                                  height="70px"
                                  alt=""
                              /></a>
                              <a href="#"
                                ><h6>{{ news.news_title }}</h6></a
                              >
                              <span>{{ format_date(news.created_at) }}</span>
                            </li>
                          </router-link>
                        </ul>
                      </div>
                      <div class="tags">
                        <div class="widget-heading">
                          <h4>Tags</h4>
                        </div>
                        <ul>
                          <li><a href="#">Photography</a></li>
                          <li><a href="#">Design</a></li>
                          <li><a href="#">Envanto</a></li>
                          <li><a href="#">Course</a></li>
                          <li><a href="#">Education</a></li>
                          <li><a href="#">College</a></li>
                          <li><a href="#">Teachers</a></li>
                          <li><a href="#">Read</a></li>
                          <li><a href="#">Excursions</a></li>
                        </ul>
                      </div>
                    </div>
                  </div> -->
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

<script>
import axios from "axios";
import moment from "moment";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "news",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      News: {},
      RecentNews: [],
      loading: true,
    };
  },
  mounted() {
    this.DataNews_id();
  },
  methods: {
    DataNews_id() {
      axios
        .get("/api/news_id")
        .then((res) => {
          this.RecentNews = res.data;
          for (var i = 0; i < res.data.length; i++) {
            if (res.data[i].news_id == this.$route.params.id) {
              this.News = {
                news_id: res.data[i].news_id,
                news_title: res.data[i].news_title,
                news_photo: res.data[i].news_photo,
                news_detail: res.data[i].news_detail,
                created_at: res.data[i].created_at,
              };
            }
            // console.log(this.News);
          }
          //   console.log(this.RecentNews);
          this.loading = false;
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

.backbt {
  background: #a12c2f;
  color: #fff;
}
.backbt:hover {
  background: #d43a3f;
}
</style>
