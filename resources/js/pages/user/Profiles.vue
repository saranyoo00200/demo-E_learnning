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
      ></div>
      <section v-else class="home-section">
        <div class="container-fluid">
          <div class="row flex-lg-nowrap">
            <div class="col">
              <div class="row">
                <div class="col mb-3">
                  <div class="card">
                    <div class="card-body">
                      <form
                        @submit="updateProFile"
                        enctype="multipart/form-data"
                        oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "")'
                      >
                        <div class="e-profile">
                          <div class="row">
                            <div class="col-12 col-sm-auto mb-3">
                              <div class="mx-auto" style="width: 140px">
                                <img
                                  v-if="DataUser.user_photo"
                                  :src="DataUser.user_photo"
                                  class="img-profile rounded-circle"
                                  alt=""
                                  width="140px;"
                                  height="140px;"
                                />
                                <img
                                  v-else
                                  src="/assets/backend/img/avatar/avatar-1.png"
                                  class="img-profile rounded-circle"
                                  alt=""
                                  width="140px;"
                                  height="140px;"
                                />
                              </div>
                            </div>
                            <div
                              class="
                                col
                                d-flex
                                flex-column flex-sm-row
                                justify-content-between
                                mb-3
                              "
                            >
                              <div
                                class="text-center text-sm-left mb-2 mb-sm-0"
                              >
                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">
                                  {{ DataUser.name }}
                                </h4>
                                <div class="text-muted mb-3">
                                  <span class="badge badge-secondary"
                                    >@{{ DataUser.username }}</span
                                  >
                                </div>
                                <i class="fa fa-fw fa-camera"></i>
                                <span>เปลี่ยนรูป</span>
                                <div class="mt-2">
                                  <button class="btn btn-info" type="button">
                                    <input
                                      type="file"
                                      @change="onFileImageChange"
                                      name="user_photo"
                                      accept="image/jpeg, image/png"
                                      multiple
                                    />
                                  </button>
                                </div>
                              </div>
                              <div class="text-center text-sm-right">
                                <div class="text-muted">
                                  <small>วันที่: {{ currentDateTime() }}</small>
                                </div>
                              </div>
                            </div>
                          </div>
                          <ul class="nav nav-tabs">
                            <li class="nav-item">
                              <a href="" class="active nav-link">การตั้งค่า</a>
                            </li>
                          </ul>
                          <div class="tab-content pt-3">
                            <div class="tab-pane active">
                              <div class="row">
                                <div class="col">
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label style="float: left"
                                          >ชื่อ - นามสกุล</label
                                        >
                                        <input
                                          v-model="FormProfile.name"
                                          class="form-control"
                                          type="text"
                                          name="name"
                                          placeholder=""
                                          required
                                        />
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-group">
                                        <label style="float: left"
                                          >รหัสผู้ใช้</label
                                        >
                                        <input
                                          v-model="FormProfile.username"
                                          class="form-control"
                                          type="text"
                                          name="username"
                                          placeholder=""
                                          readonly
                                        />
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label style="float: left">อีเมล</label>
                                        <input
                                          v-model="FormProfile.email"
                                          class="form-control"
                                          type="text"
                                          name="email"
                                          placeholder="user@example.com"
                                          required
                                        />
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-group">
                                        <label style="float: left"
                                          >เบอร์โทร</label
                                        >
                                        <input
                                          v-model="FormProfile.phone"
                                          class="form-control"
                                          type="text"
                                          name="phone"
                                          placeholder=""
                                          required
                                        />
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-12 col-sm-6 mb-3">
                                  <div class="mb-2">
                                    <b>เปลี่ยนรหัสผ่าน</b>
                                  </div>
                                  <!-- <a href="/password/reset" class="btn btn-info"
                                    >ส่งทางอีเมล
                                  </a> -->
                                  <div class="row">
                                    <div
                                      v-if="FormProfile.password_confirmation"
                                      class="col"
                                    >
                                      <div class="form-group">
                                        <label style="float: left"
                                          >รหัสผ่านใหม่</label
                                        >
                                        <input
                                          v-model="FormProfile.password"
                                          class="form-control required"
                                          type="password"
                                          name="password"
                                          placeholder="••••••"
                                          required
                                        />
                                      </div>
                                    </div>
                                    <div v-else class="col">
                                      <div class="form-group">
                                        <label style="float: left"
                                          >รหัสผ่านใหม่</label
                                        >
                                        <input
                                          v-model="FormProfile.password"
                                          class="form-control required"
                                          type="password"
                                          name="password"
                                          placeholder="••••••"
                                        />
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label style="float: left">
                                          <span class="d-none d-xl-inline"
                                            >ยืนยันรหัสผ่าน</span
                                          ></label
                                        >
                                        <input
                                          v-model="
                                            FormProfile.password_confirmation
                                          "
                                          class="form-control"
                                          type="password"
                                          name="password_confirmation"
                                          placeholder="••••••"
                                        />
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col d-flex justify-content-end">
                                  <button class="btn btn-primary">
                                    บันทึก
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
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
  name: "dashboard",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      loading: true,
      DataUser: {},
      FormProfile: {
        name: "",
        username: "",
        email: "",
        phone: "",
        password: "",
        password_confirmation: "",
      },
      file_photo: "",
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
          this.loading = false;

          //   alert("Axios Dashboard Success!!");
          for (let i = 0; i < res.data.length; i++) {
            this.DataUser = {
              id: res.data[i].id,
              name: res.data[i].name,
              email: res.data[i].email,
              username: res.data[i].username,
              phone: res.data[i].phone,
              user_photo: res.data[i].user_photo,
            };
          }
          this.FormProfile = {
            id: this.DataUser.id,
            name: this.DataUser.name,
            email: this.DataUser.email,
            username: this.DataUser.username,
            phone: this.DataUser.phone,
          };
          //   console.log(this.FormProfile);
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
  },
  methods: {
    currentDateTime() {
      const current = new Date();
      const date =
        (current.getDate() < 10 ? "0" : "") +
        current.getDate() +
        "-" +
        (current.getMonth() < 9 ? "0" : "") +
        (current.getMonth() + 1) +
        "-" +
        (current.getFullYear() + 543);
      const dateTime = date;

      return dateTime;
    },
    logout() {
      axios
        .post("/api/auth/logout", { token: this.$store.state.token })
        .then((res) => {
          this.$store.commit("clearToken");
          this.$router.push("/learning/login");
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    onFileImageChange(e) {
      const file = e.target.files[0];
      this.DataUser.user_photo = URL.createObjectURL(file);

      //   this.filename = "Selected File: " + e.target.files[0].name;
      this.file_photo = e.target.files[0];
      //   console.log(this.file_photo);
    },
    updateProFile(e) {
      e.preventDefault();

      const config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };

      let formData = new FormData();
      formData.append("user_photo", this.file_photo);
      formData.append("name", this.FormProfile.name);
      formData.append("username", this.FormProfile.username);
      formData.append("email", this.FormProfile.email);
      formData.append("phone", this.FormProfile.phone);
      if (this.FormProfile.password) {
        formData.append("password", this.FormProfile.password);
        formData.append(
          "password_confirmation",
          this.FormProfile.password_confirmation
        );
      }

      // update original!
      axios
        .post("/api/update_profile/" + this.DataUser.id, formData, config)
        .then((res) => {
          this.$router.go();
          this.$store.commit("addUser_name", this.FormProfile.name);
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
  },
};
</script>

<style scoped>
#content {
  margin-top: 7%;
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
</style>
