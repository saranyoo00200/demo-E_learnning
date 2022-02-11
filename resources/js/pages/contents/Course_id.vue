<template>
  <div id="main">
    <div id="header" class="mb-5">
      <HeaderComponent />
    </div>

    <div class="container" id="content">
      <div
        v-if="this.loading"
        id="load"
        class="d-flex align-items-center"
      ></div>
      <div v-else class="row">
        <div class="col-md-8">
          <div class="mb-2">
            <h4>{{ posts.subjectName }}</h4>
            <h4>{{ posts.subjectId }}</h4>
            <router-link
              @click.native="moveUp()"
              :to="{
                name: 'content_categorie',
                params: { id: category.subjectType },
              }"
            >
              <a class="text-white boxbt one mb-4 p-1" style="text-">
                หมวดหมู่วิชา {{ category.category_name }}
              </a>
            </router-link>
          </div>
          <div class="text-center mb-2">
            <img
              class="rounded border border-dark"
              :src="posts.image"
              width="345px"
              height="235px"
              alt=""
            />
          </div>
          <div>
            <h4>คำอธิบายรายวิชา</h4>
            <br />
            <p style="text-indent: 50px">{{ posts.title }}</p>
          </div>
          <div>
            <h4>พัฒนาวิชาโดย</h4>
            <br />
            <p>
              <span><i class="fa fa-user" aria-hidden="true"></i></span>
              {{ posts.name }}
            </p>
            <p>
              <span><i class="fa fa-phone" aria-hidden="true"></i></span>
              {{ posts.phone }}
            </p>
            <p>
              <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
              <a href="http://jigsawinnovation.com/">{{ posts.email }}</a>
            </p>
          </div>
        </div>
        <div class="decoration-inside"></div>
        <div class="col-md">
          <div class="text-center">
            <img
              src="/assets/frontend/images/jigsawinnovation.png"
              width="120px"
              height="120px"
              alt=""
              style="border-radius: 5px"
            /><br />
            <p><b>jigsaw innovation</b></p>
          </div>
          <div v-show="this.sync_id != ''">
            <p>กําหนดวันเปิด - ปิดคอร์สเรียน[ออนไลน์]</p>
            <span
              ><i class="bx bxs-calendar" aria-hidden="true"></i>
              {{ format_date(course_date.start_date) }} -
              {{ format_date(course_date.end_date) }}</span
            >
            <hr />
          </div>
          <div>
            <div>
              <p>ภาษาที่ใช้สอน</p>
              <span><i class="fa fa-language" aria-hidden="true"></i> TH</span>
              <hr />
            </div>
            <div>
              <p>ค่าใช้จ่าย</p>
              <span><i class="fa fa-money" aria-hidden="true"></i> Free</span>
              <hr />
            </div>
            <div>
              <p>ลักษณะรายวิชา</p>
              <span v-show="this.sync_id == ''"
                ><i class="fa fa-window-restore" aria-hidden="true"></i>
                self-paced</span
              >
              <span v-show="this.sync_id != ''"
                ><i class="fa fa-window-restore" aria-hidden="true"></i>
                learn-online</span
              >
              <hr />
            </div>
            <div>
              <p>ประกาศนียบัตร</p>
              <span
                ><i class="fas fa-certificate" aria-hidden="true"></i> เรียนครบ
                100% ของคอร์ส
              </span>
              <hr />
            </div>
            <div>
              <a
                v-if="
                  this.checkAlertRegister != 0 ||
                  this.checkAlertRegisterSim != 0
                "
                class="btn btn-secondary disabled text-white"
                style="cursor: pointer; text-decoration: none"
                >ลงทะเบียนไปแล้ว</a
              >
              <a
                v-else
                v-show="
                  this.$store.state.user_type == 2 ||
                  this.$store.state.user_type == 1 ||
                  this.$store.state.user_type == ''
                "
                @click="[clickRegisterSubject(), moveUp()]"
                class="boxbt2 text-white"
                style="cursor: pointer; text-decoration: none"
                >ลงทะเบียน</a
              >
              <a
                v-show="this.$store.state.user_type == 3"
                class="btn btn-secondary disabled text-white"
                style="cursor: pointer; text-decoration: none"
                >ไม่สามารถลงทะเบียนได้</a
              >
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

    <div id="footer">
      <FooterComponent />
    </div>
  </div>
</template>

<script scoped>
import axios from "axios";
import moment from "moment";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "course",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      posts: {},
      sync_id: "",
      synch_amount: "",
      loading: true,
      countAmount: "",
      category: {},
      course_date: {},
      checkAlertRegister: 0,
      checkAlertRegisterSim: 0,
    };
  },
  mounted() {
    this.count_amount_and_sync_id();
    this.DataPost_id();
    axios
      .get("/api/dataClass_student")
      .then((res) => {
        for (let i = 0; i < res.data.data.length; i++) {
          if (
            res.data.data[i].subject_id == this.$route.params.id &&
            res.data.data[i].user_id == this.$store.state.user_id
          ) {
            this.checkAlertRegister++;
          }
        }
        for (let i = 0; i < res.data.simulations.length; i++) {
          if (
            res.data.simulations[i].subject_id == this.$route.params.id &&
            res.data.simulations[i].user_id == this.$store.state.user_id
          ) {
            this.checkAlertRegisterSim++;
          }
        }
        // console.log(this.checkAlertRegister);
        // console.log(this.checkAlertRegisterSim);
        this.loading = false;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  methods: {
    DataPost_id() {
      axios
        .get("/api/subject_id/" + this.$route.params.id)
        .then((res) => {
          this.posts = {
            id: res.data[0].id,
            image: res.data[0].image,
            subjectName: res.data[0].subjectName,
            title: res.data[0].title,
            subjectType: res.data[0].subjectType,
            subjectId: res.data[0].subjectId,
            name: res.data[0].name,
            phone: res.data[0].phone,
            email: res.data[0].email,
          };
          //   this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    count_amount_and_sync_id() {
      axios
        .get("/api/count_synch_amount/" + this.$route.params.id)
        .then((res) => {
          //count_amount
          this.countAmount = res.data.countAmount;
          //sync_id and course_date
          for (let i = 0; i < res.data.subjectLeasson.length; i++) {
            //sync_id
            this.synch_amount = res.data.subjectLeasson[i].synch_amount;
            this.sync_id = res.data.subjectLeasson[i].sync_id;
            //course_date
            this.course_date = {
              start_date: res.data.subjectLeasson[i].start_date,
              end_date: res.data.subjectLeasson[i].end_date,
            };
          }
          //category
          this.category = {
            category_name: res.data.category[0].category_name,
            subjectType: res.data.category[0].subjectType,
          };
          //   console.log(this.course_date);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    moveUp() {
      window.scrollTo(0, 0);
    },
    clickRegisterSubject() {
      // console.log(this.checkAlertRegisterSim);
      if (this.$store.state.token !== "") {
        if (confirm("คุณต้องการลงทะเบียนหรือไม่?")) {
          if (this.sync_id != "") {
            if (
              this.checkAlertRegister != 0 ||
              this.checkAlertRegisterSim != 0
            ) {
              this.alertRegister2();
            } else {
              if (this.countAmount >= this.synch_amount) {
                this.alertRegister();
              } else {
                this.calendarSimulation();
              }
            }
          }
          if (this.sync_id == "") {
            if (this.checkAlertRegister != 0) {
              this.alertRegister2();
            } else {
              this.calendarSimulation();
            }
          }
          // console.log(res.data[0].synch_amount);
        }
      } else {
        //   alert("error this.$store.state.token!!");
        this.loading = false;
        this.$store.commit("addCourse_id", this.$route.params.id);
        this.$router.push("/learning/login");
      }
    },
    calendarSimulation() {
      if (this.sync_id != "") {
        const config = {
          headers: {
            "content-type": "multipart/form-data",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
              .content,
          },
        };

        let formData = new FormData();
        formData.append("user_id", this.$store.state.user_id);
        formData.append("subject_id", this.$route.params.id);
        formData.append("sync_id", this.sync_id);

        axios
          .post("/api/calendar_simulations", formData, config)
          .then((res) => {
            // console.log(this.sync_id);
            this.$router.push("/learning/calendar_simulations");
          })
          .catch((err) => {
            this.error = "Error!!";
          });
      } else {
        const config = {
          headers: {
            "content-type": "multipart/form-data",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
              .content,
          },
        };

        let formData = new FormData();
        formData.append("user_add", this.$store.state.user_id);
        formData.append("sync_id", this.sync_id);
        formData.append("subject_id", this.$route.params.id);

        axios
          .post("/api/select_subject", formData, config)
          .then((res) => {
            // console.log(this.sync_id);
            this.$router.push("/learning/dashboard/lessons");
          })
          .catch((err) => {
            this.error = "Error!!";
          });
      }
    },
    alertRegister() {
      alert("ไม่สามารถลงทะเบียนได้เนื่องจากคอร์ดเรียนนี้เต็มแล้ว!!");
    },
    alertRegister2() {
      alert("ไม่สามารถลงทะเบียนได้เนื่องจากได้ลงทะเบียนไปแล้ว!!");
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


<style scoped>
/* ##### >> https://fonts.google.com/specimen/Sarabun?query=sara#standard-styles */
@import url("https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap");
#content {
  margin-top: 10%;
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
h5,
h6 {
  font-family: "Sarabun", sans-serif;
}
.one {
  text-decoration: none;
}
.boxbt {
  width: 80px;
  height: 30px;
  border-radius: 20px;
  background: #728fce;
  border-radius: 3px;
  /* float: left; */
  text-align: center;
  line-height: 30px;
  color: white;
  font-size: 15px;
}
.boxbt:hover {
  background: linear-gradient(135deg, #728fce, #96a9d3);
  box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
}
.boxbt2 {
  width: 80px;
  height: 30px;
  border-radius: 20px;
  background: #728fce;
  border-radius: 3px;
  float: left;
  text-align: center;
  line-height: 30px;
  color: white;
  font-size: 15px;
}
.boxbt2:hover {
  background: linear-gradient(135deg, #728fce, #96a9d3);
  box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
}

.backbt {
  background: #a12c2f;
  color: #fff;
}
.backbt:hover {
  background: #d43a3f;
}

.decoration-inside {
  height: 750px;
  width: 2px;
  background-color: rgb(222, 222, 222);
  display: block;
}
</style>
