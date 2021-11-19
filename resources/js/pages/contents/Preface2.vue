<template>
  <div id="main">
    <div id="header">
      <HeaderComponent />
    </div>
    <div class="container" id="content">
      <div
        id="load"
        v-if="this.loading"
        class="d-flex align-items-center"
      ></div>
      <div v-else>
        <section>
          <div class="welcome-intro mb-3">
            <div class="container">
              <div class="mb-4">
                <!-- <h3>ยินดีต้อนรับสู่บทเรียนออนไลน์</h3> -->
                <a href="#">{{ DataIntro.subjectName }}</a>
                <hr />
              </div>

              <!-- <div class="section-body">
                <div class="row">
                  <div class="col-md-4">
                    <img
                      :src="DataIntro.image"
                      alt=""
                      width="280px"
                      height="280px"
                    />
                  </div>
                  <div class="col-md-8">
                    <h2>บทนำ</h2>
                    <p
                      style="text-indent: 50px"
                      :inner-html.prop="DataIntro.title"
                    ></p>
                  </div>
                </div>
              </div> -->
              <div class="section-body">
                <div
                  class="mb-4"
                  style="
                    text-align: center;
                    font-size: 40px;
                    text-decoration: underline;
                  "
                >
                  บทนำ
                </div>
                <div class="row">
                  <img
                    class="container mb-4 img-thumbnail"
                    :src="DataIntro.image"
                    alt=""
                    style="
                      width: 60%;
                      box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px,
                        rgba(0, 0, 0, 0.24) 0px 1px 2px;
                      padding-left: 0;
                      padding-right: 0;
                      padding-top: 0;
                      padding-bottom: 0;
                    "
                  />
                  <!-- <h2>บทนำ</h2> -->
                  <p
                    class="container"
                    style="text-indent: 50px"
                    :inner-html.prop="DataIntro.title"
                  ></p>
                </div>
              </div>
              <div class="row">
                <a
                  v-show="this.checkRedirect == 0"
                  class="btn btn-warning"
                  style="
                    box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px,
                      rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
                    margin-right: 10px;
                  "
                  @click="redirectPageToPretest"
                  ><i class="fas fa-question-circle"></i>
                  ทำแบบทดสอบก่อนเรียน
                </a>

                <router-link
                  v-show="this.checkRedirect == 1"
                  class="btn btn-primary"
                  style="
                    box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px,
                      rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
                    margin-right: 10px;
                  "
                  tage="button"
                  :to="{
                    name: 'lesson',
                    params: { id: this.$route.params.id },
                  }"
                  ><i class="fas fa-play"></i>
                  เข้าสู่บทเรียน
                </router-link>

                <a
                  class="btn btn-info"
                  type="button"
                  @click="$router.go(-1)"
                  style="text-decoration: none; color: white"
                  ><i class="fas fa-chevron-left"></i> กลับ
                </a>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

    <div class="footer" id="footer">
      <FooterComponent />
    </div>
  </div>
</template>

<script scoped>
import axios from "axios";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "preface2",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      loading: true,
      DataIntro: [],
      checkRedirect: 0,
    };
  },
  mounted() {
    if (this.$store.state.token == "") {
      this.loading = false;
      this.$router.push("/learning/login");
    }

    this.subject_intro();
    this.checkRedirectPage();
  },
  methods: {
    subject_intro() {
      axios
        .get("/api/subject_intro/" + this.$route.params.id)
        .then((res) => {
          for (let i = 0; i < res.data.length; i++) {
            if (res.data[i].introduction_id == this.$route.params.id) {
              this.DataIntro = {
                image: res.data[i].image,
                subjectName: res.data[i].subjectName,
                title: res.data[i].title,
              };
            }
          }
          //   console.log(this.DataIntro);
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    checkRedirectPage() {
      axios
        .get(
          "/api/checkRedirectPage/" +
            this.$route.params.id +
            "/" +
            this.$store.state.user_id
        )
        .then((res) => {
          //   console.log(res.data);
          if (res.data != "") {
            this.checkRedirect++;
          }
          this.loading = false;
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    redirectPageToPretest() {
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
        .post("/api/redirect_save/intro_progress", formData, config)
        .then((res) => {})
        .catch((err) => {
          this.error = "Error!!";
        });
      this.$router.push({
        name: "pretest",
        params: { id: this.$route.params.id },
      });
    },
  },
};
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
#content {
  margin-top: -2%;
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
