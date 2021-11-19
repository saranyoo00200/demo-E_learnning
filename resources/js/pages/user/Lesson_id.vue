<template>
  <div id="main">
    <div id="header">
      <HeaderComponent />
    </div>
    <div class="container" id="content">
      <div
        v-if="this.loading"
        id="load"
        class="d-flex align-items-center"
        style="padding-top: 10em"
      ></div>
      <div v-else>
        <h4 style="text-align: center">รายวิชา {{ posts[0].subjectName }}</h4>
        <hr />
        <br />
        <!-- <span
          ><p>{{ posts }}</p></span
        > -->
        <div class="container">
          <div class="" v-for="post in posts" :key="post.id">
            <div class="col-md-4">
              <span class="text-secondary" style="text-decoration: underline">{{
                post.subjectName
              }}</span
              ><br />
              <span class="text-secondary" style="text-decoration: underline">{{
                post.subjectId
              }}</span
              ><br />
              <img
                class="image-preview mt-3"
                :src="post.image"
                alt=""
                style="width: 100%; float: center"
              />
            </div>
            <div class="col-md-8">
              <div class="vl">
                <div class="mb-3" style="text-indent: 2.5em">
                  <span>{{ post.title }}</span>
                </div>
                <span
                  ><p class="text-secondary">
                    <i class="fas fa-chalkboard-teacher"></i> อาจารย์:
                    {{ post.name }}
                  </p>
                </span>
                <span
                  ><p class="text-secondary">
                    <i class="far fa-envelope"></i> อีเมล: {{ post.email }}
                  </p>
                </span>
                <span
                  ><p class="text-secondary">
                    <i class="fas fa-phone-alt"></i> ติดต่อ: {{ post.phone }}
                  </p>
                </span>
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
        ><i class="fas fa-chevron-left"></i> กลับ
      </a>
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
  name: "dashboard",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      loading: true,
      posts: {},
    };
  },
  mounted() {
    if (this.$store.state.token !== "") {
      axios
        .get("/api/auth/user-profile/", {
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + this.$store.state.token,
          },
        })
        .then((res) => {
          //   alert("Axios Dashboard Success!!");
          //   this.DataUser = res.data;
          this.loading = false;
        })
        .catch((err) => {
          //   alert("error axios Dashboard!!");
          this.$store.commit("clearToken");
          this.$router.push("/learning/login");
        });
    } else {
      //   alert("error this.$store.state.token!!");
      this.loading = false;
      this.$router.push("/learning/login");
    }
    this.my_subject_leasson();
    // console.log(this.$store.state.user.id);
  },
  methods: {
    my_subject_leasson() {
      axios
        .get("/api/subject_id/" + this.$route.params.id)
        .then((res) => {
          this.posts = res.data;
          //   console.log(res.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
/* ##### >> https://fonts.google.com/specimen/Sarabun?query=sara#standard-styles */
@import url("https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap");
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
#content {
  margin-top: 10%;
}
h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "Sarabun", sans-serif;
}

.backbt {
  background: #a12c2f;
  color: #fff;
}
.backbt:hover {
  background: #d43a3f;
}
.vl {
  border-left: 2px solid orangered;
  height: 400px;
  padding: 1.5em;
}
</style>
