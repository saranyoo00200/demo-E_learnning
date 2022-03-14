<template>
  <div id="main">
    <div id="header">
      <HeaderComponent />
    </div>

    <div class="container-fluid" id="content">
      <div
        v-if="this.loading"
        id="load"
        class="d-flex align-items-center"
      ></div>
      <section v-else class="home-section">
        <div class="row">
          <div class="col-md-7 mb-5">
            <h4>
              <b>ปฎิทิน / ตารางเวลาเรียน => <u>(จำลอง)</u></b>
            </h4>
            <hr />
            <FullCalendar :options="calendarOptions" />
          </div>
          <div class="col-md-5">
            <h4>
              <b>รายวิชาที่เลือกลงทะเบียน</b
              ><router-link
                class="btn btn-outline-secondary float-right"
                @click.native="moveUp()"
                to="/learning/course"
                >เลือกวิชาเรียน</router-link
              >
            </h4>
            <hr />
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">รหัสวิชา</th>
                  <th scope="col">ชื่อวิชา</th>
                  <th scope="col">เครื่องมือ</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="data in dataSimulations" :key="data.id">
                  <th scope="row">#</th>
                  <td>
                    <u>{{ data.subjectId }}</u>
                  </td>
                  <td>{{ data.subjectName }}</td>
                  <td>
                    <button
                      class="btn btn-danger"
                      @click="destroySimulation(data.id)"
                    >
                      ลบ
                    </button>
                  </td>
                </tr>
              </tbody>
              <tbody v-show="dataSimulations == ''" class="text-center">
                <tr>
                  <th scope="row" colspan="4">ไม่มีข้อมูล</th>
                </tr>
              </tbody>
            </table>
            <div class="text-center bg-light p-3">
              <span
                ><p><b>นักเรียนโปรดตรวจสอบรายการลงทะเบียน</b></p></span
              >
              <span
                ><p class="text-danger">
                  <b><u>เมื่อนักเรียนมั่นใจแล้ว กรุณากดปุ่ม</u></b>
                </p></span
              >
              <button
                class="btn btn-secondary shadow rounded"
                @click="createRegister"
              >
                ยืนยันการลงทะเบียน
              </button>
            </div>
          </div>
        </div>
        <button class="btn btn-info float-right my-3" @click="$router.go(-1)">
          <i class="fas fa-chevron-left"></i> กลับ
        </button>
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
import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import timeGridPlugin from "@fullcalendar/timegrid";

export default {
  name: "timetables",
  components: { HeaderComponent, FooterComponent, FullCalendar },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin, listPlugin, timeGridPlugin],
        initialView: "dayGridMonth",
        selectable: true,
        dateClick: this.handleDateClick,
        events: [
          {
            title: "",
            start: "",
            end: "",
          },
        ],
        eventColor: "black",
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "timeGridDay,timeGridWeek,dayGridMonth,listWeek", //listWeek
        },
        locale: "th",
        slotLabelFormat: { hour12: false, hour: "2-digit", minute: "2-digit" },
        buttonText: {
          today: "วันนี้",
          month: "เดือน",
          week: "สัปดาห์",
          day: "วัน",
          list: "กำหนดการ",
        },
      },
      loading: true,
      dataSimulations: [],
      check_sync_to_subject_id: [],
      currentCompare: [],
      sentDataRegister: [],
    };
  },
  mounted() {
    if (this.$store.state.token !== "") {
      axios
        .get("/api/my_subject_leasson/" + this.$store.state.user_id)
        .then((res) => {
          //   this.loading = false;
          if (res.data != "") {
            this.DataCalendar();
          }
          this.dataSimulation();
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    } else {
      //   alert("error this.$store.state.token!!");
      this.loading = false;
      this.$router.push("/learning/login");
    }
  },
  created() {
    this.DataCalendar();
    // this.dataSimulation();
  },
  methods: {
    handleDateClick: function (arg) {
      alert("date click! " + arg.dateStr);
    },
    moveUp() {
      window.scrollTo(0, 0);
    },
    DataCalendar() {
      axios
        .get("/api/showdata_time_simulations/" + this.$store.state.user_id)
        .then((res) => {
          // console.log(res.data);
          this.currentCompare = [];
          this.calendarOptions.events = [];
          for (let i = 0; i < res.data.length; i++) {
            this.calendarOptions.events[i] = {
              end: res.data[i].end,
              start: res.data[i].start,
              title: res.data[i].title,
            };
            this.currentCompare[i] = {
              end: res.data[i].end,
              start: res.data[i].start,
              title: res.data[i].title,
            };
          }
          //   console.log(this.currentCompare);
          this.loading = false;
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    dataSimulation() {
      axios
        .get("/api/show_data_simulations/" + this.$store.state.user_id)
        .then((res) => {
          // console.log(res.data.length);
          this.sentDataRegister = [];
          this.dataSimulations = res.data;
          for (let i = 0; i < res.data.length; i++) {
            axios
              .get("/api/check_sync_to_subject_id/" + res.data[i].subject_id)
              .then((res) => {
                // console.log(res.data.data);
                this.sentDataRegister.push({
                  subject_id: res.data.check_data[0].subject_id,
                  sync_id: res.data.check_data[0].sync_id,
                  user_add: this.$store.state.user_id,
                });

                for (let i = 0; i < res.data.data.length; i++) {
                  this.check_sync_to_subject_id[i] = {
                    end: res.data.data[i].end,
                    start: res.data.data[i].start,
                    title: res.data.data[i].title,
                  };
                  this.calendarOptions.events.push(
                    this.check_sync_to_subject_id[i]
                  );
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
          //   console.log(this.sentDataRegister);
          //   console.log(this.calendarOptions.events);
          this.loading = false;
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    destroySimulation(dataDelete) {
      axios
        .get("/api/destroy_simulation/" + dataDelete)
        .then((res) => {
          this.DataCalendar();
          this.dataSimulation();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    createRegister() {
      //   console.log(this.sentDataRegister);
      if (this.sentDataRegister[0] != undefined) {
        if (confirm("ยืนยันการลงทะเบียน")) {
          for (let i = 0; i < this.sentDataRegister.length; i++) {
            const config = {
              headers: {
                "content-type": "multipart/form-data",
                "X-CSRF-TOKEN": document.querySelector(
                  'meta[name="csrf-token"]'
                ).content,
              },
            };
            let formData = new FormData();
            formData.append("user_id", this.$store.state.user_id);
            formData.append("sync_id", this.sentDataRegister[i].sync_id);
            formData.append("subject_id", this.sentDataRegister[i].subject_id);
            axios
              .post("/api/select_subject", formData, config)
              .then((res) => {
                if (res.data.data == true) {
                  this.checkAlert2();
                } else {
                  this.$router.push("/learning/dashboard/lessons");
                }
              })
              .catch((err) => {
                this.error = "Error!!";
              });
          }
        }
      } else {
        alert("ยังไม่ได้เลือกวิชาเรียน!!");
      }
    },
    checkAlert() {
      alert("สามารถเพิ่มได้");
    },
    checkAlert2() {
      alert("เวลาซ้ำซ้อนกัน!!");
    },
  },
};
</script>


<style scoped>
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
</style>
