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
      <section v-else class="home-section">
        <h4><b>ปฎิทิน / ตารางเวลาเรียน</b></h4>
        <hr />
        <FullCalendar :options="calendarOptions" />
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
        // eventColor: 'info',
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
    };
  },
  mounted() {
    if (this.$store.state.token !== "") {
      axios
        .get("/api/my_subject_leasson/" + this.$store.state.user_id)
        .then((res) => {
        //   console.log(res.data);
          for (let i = 0; i < res.data.length; i++) {
            if (res.data[i].student_status == "1") {
              this.DataCalendar();
            }
            this.loading = false;
          }
          this.loading = false;
        })
        .catch((err) => {
          this.error = "Error!!";
        });

      //   this.loading = false;
    } else {
      //   alert("error this.$store.state.token!!");
      this.loading = false;
      this.$router.push("/learning/login");
    }
  },
  methods: {
    handleDateClick: function (arg) {
      alert("date click! " + arg.dateStr);
    },
    DataCalendar() {
      axios
        .get("/api/showdata_time/" + this.$store.state.user_id)
        .then((res) => {
          this.calendarOptions.events = [];
          for (let i = 0; i < res.data.length; i++) {
            this.calendarOptions.events[i] = {
              end: res.data[i].end,
              start: res.data[i].start,
              title: res.data[i].title,
            };
          }
          // console.log(res.data);
          this.loading = false;
        })
        .catch((err) => {
          this.loading = false;
          this.error = "Error!!";
        });
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
