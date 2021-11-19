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
      <main v-else class="content">
        <div class="container p-0">
          <div class="card" style="margin-top: 2%">
            <div class="row g-0">
              <div class="col-12 col-lg-5 col-xl-3 border-right">
                <div class="px-4 d-none d-md-block">
                  <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                      <input
                        type="search"
                        v-model="search"
                        class="form-control my-3"
                        placeholder="Search..."
                      />
                    </div>
                  </div>
                </div>

                <div v-for="(fr, index) in filteredSheeps" :key="index">
                  <a
                    @click="clickActives(fr.sync_id)"
                    href="#"
                    class="list-group-item list-group-item-action border-0"
                  >
                    <!-- <div class="badge bg-success float-right">5</div> -->
                    <div class="d-flex align-items-start">
                      <img
                        :src="fr.image"
                        class="rounded-circle mr-1"
                        width="40"
                        height="40"
                      />
                      <div class="flex-grow-1 ml-3">
                        {{ fr.subjectName }}
                        <div class="small">
                          <span class="fas fa-circle chat-online"></span> Online
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
                <hr class="d-block d-lg-none mt-1 mb-0" />
              </div>
              <div class="col-12 col-lg-7 col-xl-9">
                <div class="py-2 px-4 border-bottom d-none d-lg-block" style="">
                  <div
                    v-if="data_fetch_room_id == ''"
                    class="d-flex align-items-center py-1"
                  >
                    <div class="position-relative">
                      <img
                        src="https://i.pinimg.com/474x/71/a3/5b/71a35b96a26d7d1a83c5491227f0f263.jpg"
                        width="40"
                        height="40"
                      />
                    </div>
                    <div class="flex-grow-1 pl-3">
                      <strong></strong>
                      <!-- <div class="text-muted small"><em>Typing...</em></div> -->
                    </div>
                  </div>
                  <div
                    class="d-flex align-items-center py-1"
                    v-for="(fr_id, index) in data_fetch_room_id"
                    :key="index"
                  >
                    <div class="position-relative">
                      <img
                        :src="fr_id.image"
                        class="rounded-circle mr-1"
                        width="40"
                        height="40"
                      />
                    </div>
                    <div class="flex-grow-1 pl-3">
                      <strong>{{ fr_id.subjectName }}</strong>
                      <!-- <div class="text-muted small"><em>Typing...</em></div> -->
                    </div>
                  </div>
                </div>

                <div class="position-relative">
                  <div class="chat-messages p-4" id="scroll">
                    <div
                      v-show="sync_id != undefined"
                      v-for="(n, index) in data"
                      :key="index"
                    >
                      <div
                        v-show="n.user_id == $store.state.user_id"
                        class="chat-message-right pb-4"
                      >
                        <div>
                          <img
                            :src="n.user_photo"
                            class="rounded-circle mr-1"
                            width="40"
                            height="40"
                          />
                        </div>
                        <div
                          class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3"
                        >
                          <div class="font-weight-bold mb-1">You</div>
                          {{ n.text }}
                          <div class="text-muted small text-nowrap mt-2">
                            {{ format_date(n.created_at) }} น.
                          </div>
                        </div>
                      </div>

                      <div
                        v-show="n.user_id != $store.state.user_id"
                        class="chat-message-left pb-4"
                      >
                        <div>
                          <img
                            :src="n.user_photo"
                            class="rounded-circle mr-1"
                            width="40"
                            height="40"
                          />
                        </div>
                        <div
                          class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3"
                        >
                          <div class="font-weight-bold mb-1">
                            {{ n.name }}
                          </div>
                          {{ n.text }}
                          <div class="text-muted small text-nowrap mt-2">
                            {{ format_date(n.created_at) }} น.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="flex-grow-0 py-3 px-4 border-top">
                  <div class="input-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Type your message"
                      v-model="messageText"
                      @keyup.enter="sendMessage"
                    />
                    <button
                      class="btn btn-primary"
                      type="button"
                      @click="sendMessage"
                    >
                      Send
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <div id="footer">
      <!-- <FooterComponent /> -->
    </div>
  </div>
</template>

<script src="https://unpkg.com/vue@2.4.2"></script>
<script>
import axios from "axios";
import moment from "moment";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "chat_messages",
  components: { HeaderComponent, FooterComponent },
  props: {
    mag: String,
  },
  data() {
    return {
      messageText: "",
      data: [
        {
          text: "",
          userName: "",
        },
      ],
      data_fetch_room: [],
      data_fetch_room_id: [],
      sync_id: "",
      search: "",
      loading: true,
    };
  },
  mounted() {
    let vm = this;
    this.$root.socket.on("chatMessage", function () {
      vm.fetchMessage();
    });
    this.fetch_room();
  },
  computed: {
    filteredSheeps: function () {
      let searchTerm = (this.search || "").toLowerCase();
      return this.data_fetch_room.filter(function (item) {
        let name = (item.subjectName || "").toLowerCase();
        return name.indexOf(searchTerm) > -1;
      });
    },
  },
  created() {
    this.clickActives();
  },
  methods: {
    sendMessage() {
      if (this.messageText != "") {
        if (this.sync_id != undefined) {
          axios({
            url: "/api/create/message",
            method: "post",
            data: {
              text: this.messageText,
              sync_id: this.sync_id,
              user_id: this.$store.state.user_id,
            },
          }).then((res) => {
            this.$root.socket.emit("chatMessage", res.data.text);
            this.text = "";
          });

          this.messageText = "";
        } else {
          alert("โปรดเลือกซ่องทางการส่งข้อความ!!");
        }
      }
    },
    fetch_room() {
      if (this.$store.state.user_type == 2) {
        axios({
          url: "/api/fetch_room/subject/message/" + this.$store.state.user_id,
          method: "get",
        }).then((res) => {
          // console.log(res.data);
          this.data_fetch_room = res.data;
          this.loading = false;
        });
      } else {
        this.loading = false;
      }
      if (this.$store.state.user_type == 3) {
        axios({
          url:
            "/api/fetch_room_teacher/subject/message/" +
            this.$store.state.user_id,
          method: "get",
        }).then((res) => {
          this.data_fetch_room = res.data;
          this.loading = false;
        });
      } else {
        this.loading = false;
      }
    },
    fetchMessage() {
      axios({
        url: "/api/fetch/" + this.sync_id + "/message",
        method: "get",
      }).then((res) => {
        this.data = res.data;
        setTimeout(() => {
          if (res.data) {
            var scroll = this.$el.querySelector("#scroll");
            scroll.scrollTop = scroll.scrollHeight;
          }
        });
      });
    },
    format_date(value) {
      if (value) {
        moment.locale("th");
        return moment(String(value)).add(543, "years").format("lll");
      }
    },
    clickActives(value) {
      this.sync_id = value;
      axios({
        url: "/api/fetch_room/subject/" + value + "/message",
        method: "get",
      }).then((res) => {
        this.data_fetch_room_id = res.data;
        this.fetchMessage();
      });
    },
  },
};
</script>

<style>
body {
  margin-top: 20px;
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

.chat-online {
  color: #34ce57;
}

.chat-offline {
  color: #e4606d;
}

.chat-messages {
  display: flex;
  flex-direction: column;
  height: 350px;
  overflow-y: scroll;
}

.chat-message-left,
.chat-message-right {
  display: flex;
  flex-shrink: 0;
}

.chat-message-left {
  margin-right: auto;
}

.chat-message-right {
  flex-direction: row-reverse;
  margin-left: auto;
}
.py-3 {
  padding-top: 1rem !important;
  padding-bottom: 1rem !important;
}
.px-4 {
  padding-right: 1.5rem !important;
  padding-left: 1.5rem !important;
}
.flex-grow-0 {
  flex-grow: 0 !important;
}
.border-top {
  border-top: 1px solid #dee2e6 !important;
}
</style>
