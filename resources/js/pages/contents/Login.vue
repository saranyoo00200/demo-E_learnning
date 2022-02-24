<template>
  <div id="logincomponent main">
    <div id="header">
      <HeaderComponent />
    </div>
    <div v-if="loading">
      <div class="spinner-border" role="status">
        <span class="visually-hidden"></span>
      </div>
    </div>
    <div class="row" v-else>
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">เข้าสู่ระบบ</h5>
            <form class="form-signin" method="POST" v-on:submit.prevent="login">
              <div class="form-label-group mb-3">
                <label for="inputUsername">Username</label>
                <input
                  v-model="credentials.username"
                  type="text"
                  name="username"
                  id="inputUsername"
                  class="form-control"
                  placeholder="username..."
                  required
                  autofocus
                />
              </div>

              <div class="form-label-group mb-3">
                <label for="inputPassword">Password</label>
                <input
                  v-model="credentials.password"
                  type="password"
                  name="password"
                  id="inputPassword"
                  class="form-control"
                  placeholder="password..."
                  required
                />
              </div>

              <!-- <div class="custom-control custom-checkbox mb-3">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="rememberMe"
                />
                <label class="custom-control-label" for="rememberMe"
                  >จดจำรหัสผ่าน</label
                >
              </div> -->
              <!-- <div class="mb-3 float-right">
                <a href="/password/reset"><u>ลืมรหัสผ่าน</u></a>
              </div> -->
              <button
                class="btn btn-lg btn-primary btn-block text-uppercase"
                type="submit"
              >
                ยืนยัน
              </button>
              <hr class="my-4" />
            </form>
          </div>
        </div>
      </div>
    </div>
    <div id="footer">
      <FooterComponent />
    </div>
  </div>
</template>

<script scoped>
import axios from "axios";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "logincomponent",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      credentials: {
        username: "user01",
        password: "1234567890",
      },
      error: "",
      //   loading: false,
      loading: true,
      long_time: "",
    };
  },
  mounted() {
    if (this.$store.state.token !== "") {
      axios
        .get("/api/auth/user-profile", {
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + this.$store.state.token,
          },
        })
        .then((res) => {
          if (res) {
            // alert("Login mounted success!!");
            this.loading = false;
            this.$router.push("/learning/dashboard");
          } else {
            // alert("Login mounted axios err!!");
            this.$router.push("/learning/login");
            this.$store.commit("clearToken");
            this.loading = false;
          }
        });
    } else {
      this.loading = false;
    }
  },
  methods: {
    login() {
      if (this.$store.state.registerCourseId !== "") {
        axios
          .post("/api/auth/login", this.credentials)
          .then((res) => {
            if (res.data.Auth_attempt == true) {
              this.$router.go();
            }
            if (res.data.access_token) {
              this.$store.commit("setToken", res.data.access_token);
              this.$store.commit("addUser_id", res.data.user.id);
              this.$store.commit("addUser_name", res.data.user.name);
              this.$store.commit("addUser_user_type", res.data.user.user_type);
              this.$router.push(
                "/learning/course/" + this.$store.state.registerCourseId
              );
            }
            this.create_long_time();
          })
          .catch((err) => {
            this.$router.go();
            // this.error = "Error!!";
          });
      } else {
        axios
          .post("/api/auth/login", this.credentials)
          .then((res) => {
            if (res.data.Auth_attempt == true) {
              this.$router.go();
            }
            if (res.data.access_token) {
              this.$store.commit("setToken", res.data.access_token);
              this.$store.commit("addUser_id", res.data.user.id);
              this.$store.commit("addUser_name", res.data.user.name);
              this.$store.commit("addUser_user_type", res.data.user.user_type);
              this.$router.push("/learning/dashboard");
            }
            this.create_long_time();
          })
          .catch((err) => {
            this.$router.go();
            // this.error = "Error!!";
          });
      }
    },
    create_long_time() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };

      let formData = new FormData();
      formData.append("user_id", this.$store.state.user_id);

      axios
        .post("/api/long_time", formData, config)
        .then((res) => {})
        .catch((err) => {
          this.error = "Error!!";
        });
    },
  },
};
</script>

<style scoped>
h5 {
  font-family: "Sarabun", sans-serif;
}
</style>
