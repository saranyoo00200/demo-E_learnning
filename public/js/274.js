(self.webpackChunk=self.webpackChunk||[]).push([[274],{4240:(r,n,t)=>{"use strict";t.d(n,{Z:()=>i});var a=t(4015),e=t.n(a),o=t(3645),s=t.n(o)()(e());s.push([r.id,"@import url(https://fonts.googleapis.com/css2?family=Arimo:wght@500&display=swap);"]),s.push([r.id,'body[data-v-35d35940]{font-family:Arimo,sans-serif}body[data-v-35d35940],html[data-v-35d35940]{display:flex;flex-direction:column;flex-wrap:wrap;height:100%;margin:0;overflow:hidden;width:100%}.box[data-v-35d35940]{background:linear-gradient(140deg,#fe2929,#cb6d51,#fe2929);background-color:#184e8e}.menu .box[data-v-35d35940]{color:#fff;font-family:Orienta,sans-serif}.btn-footer[data-v-35d35940]{color:#fff;position:relative;transition:all .5s}.btn-footer[data-v-35d35940]:before{background-color:rgba(255,255,255,.1);content:"";height:100%;left:0;position:absolute;top:0;transition:all .3s;width:100%;z-index:1}.btn-footer[data-v-35d35940]:hover:before{opacity:0;transform:scale(.5)}.btn-footer[data-v-35d35940]:after{border:1px solid rgba(255,255,255,.5);content:"";height:100%;left:0;opacity:0;position:absolute;top:0;transform:scale(1.2);transition:all .3s;width:100%;z-index:1}.btn-footer[data-v-35d35940]:hover:after{opacity:1;transform:scale(1)}',"",{version:3,sources:["webpack://./resources/js/components/FooterComponent.vue"],names:[],mappings:"AAuGA,sBACA,4BACA,CAEA,4CAMA,YAAA,CACA,qBAAA,CACA,cAAA,CALA,WAAA,CAEA,QAAA,CADA,eAAA,CAFA,UAOA,CAEA,sBACA,0DAAA,CACA,wBACA,CACA,4BACA,UAAA,CACA,8BACA,CAOA,6BACA,UAAA,CAEA,iBAAA,CADA,kBAEA,CACA,oCAQA,qCAAA,CAPA,UAAA,CAKA,WAAA,CAFA,MAAA,CAFA,iBAAA,CACA,KAAA,CAMA,kBAAA,CAJA,UAAA,CAEA,SAGA,CACA,0CACA,SAAA,CACA,mBACA,CACA,mCAUA,qCAAA,CATA,UAAA,CAKA,WAAA,CAFA,MAAA,CAIA,SAAA,CANA,iBAAA,CACA,KAAA,CAQA,oBAAA,CAFA,kBAAA,CAJA,UAAA,CAEA,SAKA,CACA,yCACA,SAAA,CACA,kBACA",sourcesContent:['<template>\r\n  <footer>\r\n    <div class="container">\r\n        <div class="row">\r\n            <div class="col-md-3">\r\n                <div class="footer-widget">\r\n                    <div class="educa-info">\r\n                        <img src="assets/images/logo-2.png" alt="">\r\n                        <div class="line-dec"></div>\r\n                        <p>Viral megings photo booth farm tab McSweeney\'s Thundercats til typewrite PBR food truck Kickstarter mumb ennui Tumblr. Jean shorts hoodiele.</p>\r\n                        <div class="text-button">\r\n                            <a href="#" style="text-decoration:none">Read More <i class="fa fa-arrow-right"></i></a>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class="col-md-3">\r\n                <div class="footer-widget">\r\n                    <div class="featured-links">\r\n                        <h2>Featured Links</h2>\r\n                        <div class="line-dec"></div>\r\n                        <ul>\r\n                            <li><a href="#">Graduation</a></li>\r\n                            <li><a href="#">Admissions</a></li>\r\n                            <li><a href="#">International</a></li>\r\n                            <li><a href="#">FAQs</a></li>\r\n                        </ul>\r\n                        <ul>\r\n                            <li><a href="#">Courses</a></li>\r\n                            <li><a href="#">About Us</a></li>\r\n                            <li><a href="#">Bookstore</a></li>\r\n                            <li><a href="#">Alumni</a></li>\r\n                        </ul>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class="col-md-3">\r\n                <div class="footer-widget">\r\n                    <div class="university-address">\r\n                        <h2>Address</h2>\r\n                        <div class="line-dec"></div>\r\n                        <ul>\r\n                            <li><i class="fas fa-home"></i>1107 Wood Street Saginaw, MI New York 48607</li>\r\n                            <li><i class="fas fa-phone"></i>+12 (34) 214 280 2000</li>\r\n                            <li><i class="fas fa-envelope"></i>support@educa.com</li>\r\n                        </ul>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class="col-md-3">\r\n                <div class="footer-widget">\r\n                    <div class="newsletters">\r\n                        <h2>News</h2>\r\n                        <div class="line-dec"></div>\r\n                        <p>Subsrcibe to our newsletter for latest updates about our site for universe.</p>\r\n                        <input type="text" class="email" name="s" placeholder="Email Address..." value="">\r\n                        <div class="accent-button">\r\n                            <a href="#">Continue</a>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div class="row">\r\n          <div class="col-md-12">\r\n              <div class="copyright-menu">\r\n                  <div class="row">\r\n                      <div class="col-md-6">\r\n                          <div class="copyright-text">\r\n                              <p>@ Copyright 2021 E-Learning, website.</p>\r\n                          </div>\r\n                      </div>\r\n                      <div class="col-md-6">\r\n                          <div class="menu ">\r\n                              <ul>\r\n                                  <li><a href="#"  class="box btn btn-footer">Home</a></li>\r\n                                  <li><a href="/learning/course" class="box btn btn-footer">Course</a></li>\r\n                                  <li><a href="/learning/news" class="box btn btn-footer">News</a></li>\r\n                                  <li><a href="/learning/teacher" class="box btn btn-footer">Teacher</a></li>\r\n                                  <li><a href="/learning/contact" class="box btn btn-footer">Contact</a></li>\r\n                              </ul>\r\n                          </div>\r\n                      </div>\r\n                  </div>\r\n              </div>\r\n          </div>\r\n        </div>     \r\n    </div>               \r\n  </footer>\r\n</template>\r\n\r\n<script>\r\nexport default {\r\n    name: \'footercomponent\',\r\n    props: {\r\n        msg:String,\r\n    },\r\n};\r\n<\/script>\r\n\r\n<style scoped>\r\n/* ##### >> https://fonts.google.com/specimen/Arimo */\r\n@import url(\'https://fonts.googleapis.com/css2?family=Arimo:wght@500&display=swap\');\r\nbody{\r\n  font-family: \'Arimo\', sans-serif;\r\n}\r\n  \r\nhtml,\r\nbody {\r\n  width: 100%;\r\n  height: 100%;\r\n  overflow: hidden;\r\n  margin: 0;\r\n  display: flex;\r\n  flex-direction: column;\r\n  flex-wrap: wrap;\r\n}\r\n/* .box { background-color: #8bddb1; } */\r\n.box {\r\n    background: linear-gradient(140deg, #fe2929, #CB6D51, #fe2929);\r\n    background-color: #184e8e;\r\n}\r\n.menu .box{\r\n  color: #FFF;\r\n  font-family: \'Orienta\', sans-serif;\r\n}\r\n\r\n/*\r\n========================\r\n      BUTTON THREE\r\n========================\r\n*/\r\n.btn-footer {\r\n  color: #FFF;\r\n  transition: all 0.5s;\r\n  position: relative;\r\n}\r\n.btn-footer::before {\r\n  content: \'\';\r\n  position: absolute;\r\n  top: 0;\r\n  left: 0;\r\n  width: 100%;\r\n  height: 100%;\r\n  z-index: 1;\r\n  background-color: rgba(255,255,255,0.1);\r\n  transition: all 0.3s;\r\n}\r\n.btn-footer:hover::before {\r\n  opacity: 0 ;\r\n  transform: scale(0.5,0.5);\r\n}\r\n.btn-footer::after {\r\n  content: \'\';\r\n  position: absolute;\r\n  top: 0;\r\n  left: 0;\r\n  width: 100%;\r\n  height: 100%;\r\n  z-index: 1;\r\n  opacity: 0;\r\n  transition: all 0.3s;\r\n  border: 1px solid rgba(255,255,255,0.5);\r\n  transform: scale(1.2,1.2);\r\n}\r\n.btn-footer:hover::after {\r\n  opacity: 1;\r\n  transform: scale(1,1);\r\n}\r\n\r\n</style>\r\n'],sourceRoot:""}]);const i=s},8510:(r,n,t)=>{"use strict";t.d(n,{Z:()=>i});var a=t(4015),e=t.n(a),o=t(3645),s=t.n(o)()(e());s.push([r.id,"@import url(https://fonts.googleapis.com/css2?family=Arimo:wght@500&display=swap);"]),s.push([r.id,".main-navbar[data-v-99809af6]{background:linear-gradient(135deg,#fe2929,#ffb3c5);background-color:#184e8e;font-family:Arimo,sans-serif;position:fixed;width:100%;z-index:1020}.main-navbar .navbar-brand[data-v-99809af6]{background:transparent;border:none;border-radius:0;box-shadow:none;color:#fff;font-weight:700;padding-bottom:.75rem;padding-top:.75rem}.main-navbar .navbar-brand[data-v-99809af6]:hover{color:#f0f0f0}.main-navbar .navbar-brand[data-v-99809af6]:focus{color:#fff}.main-navbar .login[data-v-99809af6]:hover{color:#d9d9d9;font-weight:700}.main-navbar .collapse .form-inline label[data-v-99809af6]{color:#d9d9d9}.main-navbar .collapse .form-inline .search-field[data-v-99809af6]{background:none;border:none;border-bottom:1px solid transparent;border-radius:0;box-shadow:none;color:#fff;color:inherit;display:inline-block;transition:border-bottom-color .3s;width:80%}.main-navbar .collapse .form-inline .search-field[data-v-99809af6]:focus{border-bottom:1px solid #ccc}.main-navbar .collapse .nav-item .nav-link[data-v-99809af6]{color:#fff}.navbar-nav>li[data-v-99809af6]{color:#fff;cursor:pointer;display:inline-flex;margin-left:2px;padding:5px;transition:all .3s linear;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.navbar-nav>li[data-v-99809af6]:hover{box-shadow:inset 0 80px 5px hsla(0,0%,100%,.15);color:#faa}.navbar-nav .nav-item .nav-link[data-v-99809af6]:focus-within{color:#dfff00;font-weight:700}@media only screen and (max-width:600px){.main-navbar[data-v-99809af6]{background:linear-gradient(135deg,#fe2929,#ffb3c5);background-color:#184e8e;font-family:Arimo,sans-serif;position:fixed;width:100%;z-index:1020}.navbar-toggler[data-v-99809af6]{float:right;margin-bottom:10px;margin-right:10px;margin-top:10px}nav .navbar-collapse ul[data-v-99809af6]{display:inline-block;margin:0;padding:0;width:100%}}","",{version:3,sources:["webpack://./resources/js/components/HeaderComponent.vue"],names:[],mappings:"AAyNA,8BAEA,kDAAA,CACA,wBAAA,CAFA,4BAAA,CAGA,cAAA,CAEA,UAAA,CADA,YAEA,CACA,4CACA,sBAAA,CAMA,WAAA,CAFA,eAAA,CACA,eAAA,CAFA,UAAA,CAMA,eAAA,CAPA,qBAAA,CADA,kBAMA,CAIA,kDACA,aACA,CACA,kDACA,UACA,CACA,2CAEA,aAAA,CADA,eAEA,CAEA,2DACA,aACA,CACA,mEAGA,eAAA,CAEA,WAAA,CAAA,mCAAA,CACA,eAAA,CAEA,eAAA,CADA,UAAA,CAEA,aAAA,CARA,oBAAA,CASA,kCAAA,CARA,SASA,CACA,yEACA,4BACA,CAEA,4DACA,UACA,CAEA,gCAIA,UAAA,CACA,cAAA,CAJA,mBAAA,CAEA,eAAA,CADA,WAAA,CAIA,yBAAA,CACA,wBAAA,CAAA,qBAAA,CAAA,oBAAA,CAAA,gBACA,CACA,sCAEA,+CAAA,CADA,UAEA,CACA,8DACA,aAAA,CACA,eACA,CAIA,yCACA,8BAEA,kDAAA,CACA,wBAAA,CAFA,4BAAA,CAGA,cAAA,CAEA,UAAA,CADA,YAEA,CACA,iCACA,WAAA,CAGA,kBAAA,CAFA,iBAAA,CACA,eAEA,CACA,yCAKA,oBAAA,CAHA,QAAA,CACA,SAAA,CACA,UAIA,CACA",sourcesContent:['<template>\r\n  <div>\r\n    <nav class="main-navbar navbar-expand-lg navbar-light bg-light sticky-top">\r\n      <router-link class="navbar-brand active" to="/" style="font-size: 25px"\r\n        >E-Learning</router-link\r\n      >\r\n      <button\r\n        class="navbar-toggler"\r\n        type="button"\r\n        data-toggle="collapse"\r\n        data-target="#navbarSupportedContent"\r\n        aria-controls="navbarSupportedContent"\r\n        aria-expanded="false"\r\n        aria-label="Toggle navigation"\r\n      >\r\n        <span class="navbar-toggler-icon"></span>\r\n      </button>\r\n      <div class="collapse navbar-collapse" id="navbarSupportedContent">\r\n        <ul class="navbar-nav mr-auto">\r\n          <li class="nav-item">\r\n            <router-link class="nav-link" to="/"\r\n              >Home <span class="sr-only">(current)</span></router-link\r\n            >\r\n          </li>\r\n          <li class="nav-item">\r\n            <router-link class="nav-link" to="/learning/course">Course</router-link>\r\n          </li>\r\n          <li class="nav-item">\r\n            <router-link class="nav-link" to="/learning/news">News</router-link>\r\n          </li>\r\n          <li class="nav-item">\r\n            <router-link class="nav-link" to="/learning/teacher">Teacher</router-link>\r\n          </li>\r\n          <li class="nav-item">\r\n            <router-link class="nav-link" to="/learning/contact">Contact</router-link>\r\n          </li>\r\n        </ul>\r\n        <div>\r\n          <div v-if="this.$store.state.token !== \'\'">\r\n            <span class="navbar-text">\r\n              <div class="row d-flex align-items-center">\r\n                <div class="col-md-0">\r\n                  <router-link to="/learning/dashboard"\r\n                    ><img\r\n                      class="rounded-circle"\r\n                      :src="DataUser.user_photo"\r\n                      width="35px"\r\n                      height="35px"\r\n                      alt=""\r\n                  /></router-link>\r\n                </div>\r\n                <div class="col-md">\r\n                  <router-link\r\n                    type="button"\r\n                    to="/learning/dashboard"\r\n                    style="text-decoration: none"\r\n                    ><h5>{{ DataUser.name }}</h5></router-link\r\n                  >\r\n                </div>\r\n              </div>\r\n            </span>\r\n            <span class="navbar-text">\r\n              \x3c!-- Example split danger button --\x3e\r\n              <div class="btn-group">\r\n                <button\r\n                  type="button"\r\n                  class="btn btn-danger dropdown-toggle dropdown-toggle-split"\r\n                  data-bs-toggle="dropdown"\r\n                  aria-expanded="false"\r\n                ></button>\r\n                <ul class="dropdown-menu">\r\n                  <li>\r\n                    <router-link class="dropdown-item" to="/learning/dashboard"\r\n                      >แดชบอร์ด</router-link\r\n                    >\r\n                  </li>\r\n                  <li>\r\n                    <router-link class="dropdown-item" to="/learning/dashboard/lessons"\r\n                      >บทเรียน</router-link\r\n                    >\r\n                  </li>\r\n                  <li>\r\n                    <router-link\r\n                      class="dropdown-item"\r\n                      to="/learning/chat"\r\n                      >แชทห้องเรียน</router-link\r\n                    >\r\n                  </li>\r\n                  <li>\r\n                    <router-link\r\n                      class="dropdown-item"\r\n                      to="/learning/dashboard/timetables"\r\n                      >ตารางเรียน</router-link\r\n                    >\r\n                  </li>\r\n                  <li>\r\n                    <router-link\r\n                      class="dropdown-item"\r\n                      to="/learning/calendar_simulations"\r\n                      >ลงทะเบียนเรียน</router-link\r\n                    >\r\n                  </li>\r\n                  <li>\r\n                    <router-link class="dropdown-item" to="/learning/dashboard/profiles"\r\n                      >แก้ไขโปรไฟล์</router-link\r\n                    >\r\n                  </li>\r\n                  \x3c!-- <li>\r\n                  <a class="dropdown-item" href="/learning/dashboard/certificates">ใบประกาศนียบัตร</a>\r\n                </li> --\x3e\r\n                  \x3c!-- <li>\r\n                  <a class="dropdown-item" href="/learning/dashboard/settings">ตั้งค่า</a>\r\n                </li> --\x3e\r\n                  <li><hr class="dropdown-divider" /></li>\r\n                  <li>\r\n                    <a class="dropdown-item"\r\n                      ><i class="fa fa-sign-out" @click="logout" id="log_out">\r\n                        Sign out</i\r\n                      ></a\r\n                    >\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </span>\r\n          </div>\r\n          <div v-else>\r\n            <router-link :to="{ name: \'login\' }"\r\n              ><span class="navbar-text">\r\n                <a\r\n                  class="login btn action-button"\r\n                  href="#"\r\n                  style="text-decoration: none"\r\n                  ><i class="fas fa-user"></i> Log In</a\r\n                ></span\r\n              ></router-link\r\n            >\r\n            <router-link :to="{ name: \'register\' }">\r\n              <span class="navbar-text">\r\n                <a\r\n                  class="btn btn-light action-button"\r\n                  role="button"\r\n                  href="#"\r\n                  style="border-radius: 50px"\r\n                  >Signup</a\r\n                >\r\n              </span>\r\n            </router-link>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </nav>\r\n    <div style="margin-bottom: 66px"></div>\r\n    <router-view></router-view>\r\n  </div>\r\n</template>\r\n\r\n<script>\r\nexport default {\r\n  name: "app",\r\n  data() {\r\n    return {\r\n      DataUser: {},\r\n    };\r\n  },\r\n  mounted() {\r\n    if (this.$store.state.token !== "") {\r\n      axios\r\n        .get("/api/auth/user-profile/", {\r\n          headers: {\r\n            "Content-Type": "application/json",\r\n            Authorization: "Bearer " + this.$store.state.token,\r\n          },\r\n        })\r\n        .then((res) => {\r\n          //   alert("Axios Dashboard Success!!");\r\n          //   this.DataUser = res.data;\r\n          for (var i = 0; i < res.data.length; i++) {\r\n            this.DataUser = {\r\n              user_photo: res.data[i].user_photo,\r\n              name: res.data[i].name,\r\n            };\r\n          }\r\n          this.loading = false;\r\n          //   console.log(this.DataUser);\r\n        })\r\n        .catch((err) => {\r\n          //   alert("error axios Dashboard!!");\r\n          this.$store.commit("clearToken");\r\n          this.$router.push("/learning/login");\r\n        });\r\n    } else {\r\n      // alert("error this.$store.state.token!!");\r\n      this.loading = false;\r\n    }\r\n  },\r\n  methods: {\r\n    logout() {\r\n      axios\r\n        .post("/api/auth/logout", { token: this.$store.state.token })\r\n        .then((res) => {\r\n          this.$store.commit("clearToken");\r\n          //   this.$store.commit("clearCourse_id");\r\n          this.$store.commit("clearUser_id");\r\n          this.$router.push("/learning/login");\r\n        })\r\n        .catch((err) => {\r\n          this.error = "Error!!";\r\n        });\r\n    },\r\n  },\r\n};\r\n<\/script>\r\n\r\n<style scoped>\r\n/* ##### >> https://fonts.google.com/specimen/Arimo */\r\n@import url("https://fonts.googleapis.com/css2?family=Arimo:wght@500&display=swap");\r\n\r\n.main-navbar {\r\n  font-family: "Arimo", sans-serif;\r\n  background: linear-gradient(135deg, #fe2929, #ffb3c5);\r\n  background-color: #184e8e;\r\n  position: fixed;\r\n  z-index: 1020;\r\n  width: 100%;\r\n}\r\n.main-navbar .navbar-brand {\r\n  background: transparent;\r\n  padding-top: 0.75rem;\r\n  padding-bottom: 0.75rem;\r\n  color: #fff;\r\n  border-radius: 0;\r\n  box-shadow: none;\r\n  border: none;\r\n}\r\n.main-navbar .navbar-brand {\r\n  font-weight: bold;\r\n}\r\n.main-navbar .navbar-brand:hover {\r\n  color: #f0f0f0;\r\n}\r\n.main-navbar .navbar-brand:focus {\r\n  color: #fff;\r\n}\r\n.main-navbar .login:hover {\r\n  font-weight: bold;\r\n  color: #d9d9d9;\r\n}\r\n/* ########## Form Search ########## */\r\n.main-navbar .collapse .form-inline label {\r\n  color: #d9d9d9;\r\n}\r\n.main-navbar .collapse .form-inline .search-field {\r\n  display: inline-block;\r\n  width: 80%;\r\n  background: none;\r\n  border: none;\r\n  border-bottom: 1px solid transparent;\r\n  border-radius: 0;\r\n  color: #fff;\r\n  box-shadow: none;\r\n  color: inherit;\r\n  transition: border-bottom-color 0.3s;\r\n}\r\n.main-navbar .collapse .form-inline .search-field:focus {\r\n  border-bottom: 1px solid #ccc;\r\n}\r\n/* ########## color li ########## */\r\n.main-navbar .collapse .nav-item .nav-link {\r\n  color: #fff;\r\n}\r\n/* ########## mouse hover li ########## */\r\n.navbar-nav > li {\r\n  display: inline-flex;\r\n  padding: 5px;\r\n  margin-left: 2px;\r\n  color: #fff;\r\n  cursor: pointer;\r\n  transition: 0.3s linear all;\r\n  user-select: none;\r\n}\r\n.navbar-nav > li:hover {\r\n  color: #faa;\r\n  box-shadow: 0 80px 5px rgba(255, 255, 255, 0.15) inset;\r\n}\r\n.navbar-nav .nav-item .nav-link:focus-within {\r\n  color: #dfff00;\r\n  font-weight: bold;\r\n}\r\n\r\n/* ########## responsive ########## */\r\n/* Extra small devices (phones, 600px and down) */\r\n@media only screen and (max-width: 600px) {\r\n  .main-navbar {\r\n    font-family: "Arimo", sans-serif;\r\n    background: linear-gradient(135deg, #fe2929, #ffb3c5);\r\n    background-color: #184e8e;\r\n    position: fixed;\r\n    z-index: 1020;\r\n    width: 100%;\r\n  }\r\n  .navbar-toggler {\r\n    float: right;\r\n    margin-right: 10px;\r\n    margin-top: 10px;\r\n    margin-bottom: 10px;\r\n  }\r\n  nav .navbar-collapse ul {\r\n    padding: 25px 15px;\r\n    margin: 0;\r\n    padding: 0;\r\n    width: 100%;\r\n    display: inline-block;\r\n    /* list-style: none; */\r\n    /* float: right; */\r\n  }\r\n}\r\n\r\n/* Small devices (portrait tablets and large phones, 600px and up) */\r\n@media only screen and (min-width: 600px) {\r\n}\r\n\r\n/* Medium devices (landscape tablets, 768px and up) */\r\n@media only screen and (min-width: 768px) {\r\n}\r\n\r\n/* Large devices (laptops/desktops, 992px and up) */\r\n@media only screen and (min-width: 992px) {\r\n}\r\n\r\n/* Extra large devices (large laptops and desktops, 1200px and up) */\r\n@media only screen and (min-width: 1200px) {\r\n}\r\n</style>\r\n'],sourceRoot:""}]);const i=s},2851:(r,n,t)=>{"use strict";t.d(n,{Z:()=>i});var a=t(4015),e=t.n(a),o=t(3645),s=t.n(o)()(e());s.push([r.id,"#content[data-v-dd0b747a]{margin-top:8%}","",{version:3,sources:["webpack://./resources/js/pages/user/Study_page.vue"],names:[],mappings:"AAsGA,0BACA,aACA",sourcesContent:['<template>\r\n  <div id="main">\r\n    <div id="header">\r\n      <HeaderComponent />\r\n    </div>\r\n    <div class="container" id="content">\r\n      <div v-if="this.loading" class="d-flex align-items-center container">\r\n        <strong>Loading...</strong>\r\n        <div\r\n          class="spinner-border ms-auto"\r\n          role="status"\r\n          aria-hidden="true"\r\n        ></div>\r\n      </div>\r\n      <div v-else>\r\n        <div>\r\n          <h4>วิชา {{ posts.subjectName }} !</h4>\r\n          <hr />\r\n        </div>\r\n      </div>\r\n    </div>\r\n\r\n    <div class="footer" id="footer">\r\n      <FooterComponent />\r\n    </div>\r\n  </div>\r\n</template>\r\n\r\n<script scoped>\r\nimport axios from "axios";\r\nimport HeaderComponent from "../../components/HeaderComponent.vue";\r\nimport FooterComponent from "../../components/FooterComponent.vue";\r\nexport default {\r\n  name: "dashboard",\r\n  components: { HeaderComponent, FooterComponent },\r\n  data() {\r\n    return {\r\n      loading: true,\r\n      sync_id: "",\r\n      posts: "",\r\n    };\r\n  },\r\n  mounted() {\r\n    if (this.$store.state.token !== "") {\r\n      axios\r\n        .get("/api/auth/user-profile/", {\r\n          headers: {\r\n            "Content-Type": "application/json",\r\n            Authorization: "Bearer " + this.$store.state.token,\r\n          },\r\n        })\r\n        .then((res) => {\r\n          //   alert("Axios Dashboard Success!!");\r\n        })\r\n        .catch((err) => {\r\n          //   alert("error axios Dashboard!!");\r\n          this.$store.commit("clearToken");\r\n          this.$router.push("/learning/login");\r\n        });\r\n    } else {\r\n      //   alert("error this.$store.state.token!!");\r\n      this.loading = false;\r\n      this.$router.push("/learning/login");\r\n    }\r\n    this.my_subject_leasson();\r\n    this.findsync_id();\r\n  },\r\n  methods: {\r\n    findsync_id() {\r\n      axios\r\n        .get("/api/data_add_lessons/" + this.$route.params.id)\r\n        .then((res) => {\r\n          this.sync_id = res.data[0];\r\n          this.loading = false;\r\n          //   console.log(res.data[0]);\r\n        })\r\n        .catch((err) => {\r\n          this.error = "Error!!";\r\n        });\r\n    },\r\n    my_subject_leasson() {\r\n      axios\r\n        .get("/api/subject_id")\r\n        .then((res) => {\r\n          for (var i = 0; i < res.data.length; i++) {\r\n            if (res.data[i].id == this.$route.params.id) {\r\n              this.posts = {\r\n                subjectName: res.data[i].subjectName,\r\n              };\r\n            }\r\n          }\r\n          // console.log(this.posts);\r\n        })\r\n        .catch((error) => {\r\n          console.log(error);\r\n        });\r\n    },\r\n  },\r\n};\r\n<\/script>\r\n\r\n<style scoped>\r\n#content {\r\n  margin-top: 8%;\r\n}\r\n</style>\r\n'],sourceRoot:""}]);const i=s},4343:(r,n,t)=>{"use strict";t.d(n,{Z:()=>l});const a={name:"footercomponent",props:{msg:String}};var e=t(3379),o=t.n(e),s=t(4240),i={insert:"head",singleton:!1};o()(s.Z,i);s.Z.locals;const l=(0,t(1900).Z)(a,(function(){var r=this,n=r.$createElement;r._self._c;return r._m(0)}),[function(){var r=this,n=r.$createElement,t=r._self._c||n;return t("footer",[t("div",{staticClass:"container"},[t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-3"},[t("div",{staticClass:"footer-widget"},[t("div",{staticClass:"educa-info"},[t("img",{attrs:{src:"assets/images/logo-2.png",alt:""}}),r._v(" "),t("div",{staticClass:"line-dec"}),r._v(" "),t("p",[r._v("Viral megings photo booth farm tab McSweeney's Thundercats til typewrite PBR food truck Kickstarter mumb ennui Tumblr. Jean shorts hoodiele.")]),r._v(" "),t("div",{staticClass:"text-button"},[t("a",{staticStyle:{"text-decoration":"none"},attrs:{href:"#"}},[r._v("Read More "),t("i",{staticClass:"fa fa-arrow-right"})])])])])]),r._v(" "),t("div",{staticClass:"col-md-3"},[t("div",{staticClass:"footer-widget"},[t("div",{staticClass:"featured-links"},[t("h2",[r._v("Featured Links")]),r._v(" "),t("div",{staticClass:"line-dec"}),r._v(" "),t("ul",[t("li",[t("a",{attrs:{href:"#"}},[r._v("Graduation")])]),r._v(" "),t("li",[t("a",{attrs:{href:"#"}},[r._v("Admissions")])]),r._v(" "),t("li",[t("a",{attrs:{href:"#"}},[r._v("International")])]),r._v(" "),t("li",[t("a",{attrs:{href:"#"}},[r._v("FAQs")])])]),r._v(" "),t("ul",[t("li",[t("a",{attrs:{href:"#"}},[r._v("Courses")])]),r._v(" "),t("li",[t("a",{attrs:{href:"#"}},[r._v("About Us")])]),r._v(" "),t("li",[t("a",{attrs:{href:"#"}},[r._v("Bookstore")])]),r._v(" "),t("li",[t("a",{attrs:{href:"#"}},[r._v("Alumni")])])])])])]),r._v(" "),t("div",{staticClass:"col-md-3"},[t("div",{staticClass:"footer-widget"},[t("div",{staticClass:"university-address"},[t("h2",[r._v("Address")]),r._v(" "),t("div",{staticClass:"line-dec"}),r._v(" "),t("ul",[t("li",[t("i",{staticClass:"fas fa-home"}),r._v("1107 Wood Street Saginaw, MI New York 48607")]),r._v(" "),t("li",[t("i",{staticClass:"fas fa-phone"}),r._v("+12 (34) 214 280 2000")]),r._v(" "),t("li",[t("i",{staticClass:"fas fa-envelope"}),r._v("support@educa.com")])])])])]),r._v(" "),t("div",{staticClass:"col-md-3"},[t("div",{staticClass:"footer-widget"},[t("div",{staticClass:"newsletters"},[t("h2",[r._v("News")]),r._v(" "),t("div",{staticClass:"line-dec"}),r._v(" "),t("p",[r._v("Subsrcibe to our newsletter for latest updates about our site for universe.")]),r._v(" "),t("input",{staticClass:"email",attrs:{type:"text",name:"s",placeholder:"Email Address...",value:""}}),r._v(" "),t("div",{staticClass:"accent-button"},[t("a",{attrs:{href:"#"}},[r._v("Continue")])])])])])]),r._v(" "),t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-12"},[t("div",{staticClass:"copyright-menu"},[t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-6"},[t("div",{staticClass:"copyright-text"},[t("p",[r._v("@ Copyright 2021 E-Learning, website.")])])]),r._v(" "),t("div",{staticClass:"col-md-6"},[t("div",{staticClass:"menu "},[t("ul",[t("li",[t("a",{staticClass:"box btn btn-footer",attrs:{href:"#"}},[r._v("Home")])]),r._v(" "),t("li",[t("a",{staticClass:"box btn btn-footer",attrs:{href:"/learning/course"}},[r._v("Course")])]),r._v(" "),t("li",[t("a",{staticClass:"box btn btn-footer",attrs:{href:"/learning/news"}},[r._v("News")])]),r._v(" "),t("li",[t("a",{staticClass:"box btn btn-footer",attrs:{href:"/learning/teacher"}},[r._v("Teacher")])]),r._v(" "),t("li",[t("a",{staticClass:"box btn btn-footer",attrs:{href:"/learning/contact"}},[r._v("Contact")])])])])])])])])])])])}],!1,null,"35d35940",null).exports},2091:(r,n,t)=>{"use strict";t.d(n,{Z:()=>l});const a={name:"app",data:function(){return{DataUser:{}}},mounted:function(){var r=this;""!==this.$store.state.token?axios.get("/api/auth/user-profile/",{headers:{"Content-Type":"application/json",Authorization:"Bearer "+this.$store.state.token}}).then((function(n){for(var t=0;t<n.data.length;t++)r.DataUser={user_photo:n.data[t].user_photo,name:n.data[t].name};r.loading=!1})).catch((function(n){r.$store.commit("clearToken"),r.$router.push("/learning/login")})):this.loading=!1},methods:{logout:function(){var r=this;axios.post("/api/auth/logout",{token:this.$store.state.token}).then((function(n){r.$store.commit("clearToken"),r.$store.commit("clearUser_id"),r.$router.push("/learning/login")})).catch((function(n){r.error="Error!!"}))}}};var e=t(3379),o=t.n(e),s=t(8510),i={insert:"head",singleton:!1};o()(s.Z,i);s.Z.locals;const l=(0,t(1900).Z)(a,(function(){var r=this,n=r.$createElement,t=r._self._c||n;return t("div",[t("nav",{staticClass:"main-navbar navbar-expand-lg navbar-light bg-light sticky-top"},[t("router-link",{staticClass:"navbar-brand active",staticStyle:{"font-size":"25px"},attrs:{to:"/"}},[r._v("E-Learning")]),r._v(" "),r._m(0),r._v(" "),t("div",{staticClass:"collapse navbar-collapse",attrs:{id:"navbarSupportedContent"}},[t("ul",{staticClass:"navbar-nav mr-auto"},[t("li",{staticClass:"nav-item"},[t("router-link",{staticClass:"nav-link",attrs:{to:"/"}},[r._v("Home "),t("span",{staticClass:"sr-only"},[r._v("(current)")])])],1),r._v(" "),t("li",{staticClass:"nav-item"},[t("router-link",{staticClass:"nav-link",attrs:{to:"/learning/course"}},[r._v("Course")])],1),r._v(" "),t("li",{staticClass:"nav-item"},[t("router-link",{staticClass:"nav-link",attrs:{to:"/learning/news"}},[r._v("News")])],1),r._v(" "),t("li",{staticClass:"nav-item"},[t("router-link",{staticClass:"nav-link",attrs:{to:"/learning/teacher"}},[r._v("Teacher")])],1),r._v(" "),t("li",{staticClass:"nav-item"},[t("router-link",{staticClass:"nav-link",attrs:{to:"/learning/contact"}},[r._v("Contact")])],1)]),r._v(" "),t("div",[""!==this.$store.state.token?t("div",[t("span",{staticClass:"navbar-text"},[t("div",{staticClass:"row d-flex align-items-center"},[t("div",{staticClass:"col-md-0"},[t("router-link",{attrs:{to:"/learning/dashboard"}},[t("img",{staticClass:"rounded-circle",attrs:{src:r.DataUser.user_photo,width:"35px",height:"35px",alt:""}})])],1),r._v(" "),t("div",{staticClass:"col-md"},[t("router-link",{staticStyle:{"text-decoration":"none"},attrs:{type:"button",to:"/learning/dashboard"}},[t("h5",[r._v(r._s(r.DataUser.name))])])],1)])]),r._v(" "),t("span",{staticClass:"navbar-text"},[t("div",{staticClass:"btn-group"},[t("button",{staticClass:"btn btn-danger dropdown-toggle dropdown-toggle-split",attrs:{type:"button","data-bs-toggle":"dropdown","aria-expanded":"false"}}),r._v(" "),t("ul",{staticClass:"dropdown-menu"},[t("li",[t("router-link",{staticClass:"dropdown-item",attrs:{to:"/learning/dashboard"}},[r._v("แดชบอร์ด")])],1),r._v(" "),t("li",[t("router-link",{staticClass:"dropdown-item",attrs:{to:"/learning/dashboard/lessons"}},[r._v("บทเรียน")])],1),r._v(" "),t("li",[t("router-link",{staticClass:"dropdown-item",attrs:{to:"/learning/chat"}},[r._v("แชทห้องเรียน")])],1),r._v(" "),t("li",[t("router-link",{staticClass:"dropdown-item",attrs:{to:"/learning/dashboard/timetables"}},[r._v("ตารางเรียน")])],1),r._v(" "),t("li",[t("router-link",{staticClass:"dropdown-item",attrs:{to:"/learning/calendar_simulations"}},[r._v("ลงทะเบียนเรียน")])],1),r._v(" "),t("li",[t("router-link",{staticClass:"dropdown-item",attrs:{to:"/learning/dashboard/profiles"}},[r._v("แก้ไขโปรไฟล์")])],1),r._v(" "),r._m(1),r._v(" "),t("li",[t("a",{staticClass:"dropdown-item"},[t("i",{staticClass:"fa fa-sign-out",attrs:{id:"log_out"},on:{click:r.logout}},[r._v("\n                      Sign out")])])])])])])]):t("div",[t("router-link",{attrs:{to:{name:"login"}}},[t("span",{staticClass:"navbar-text"},[t("a",{staticClass:"login btn action-button",staticStyle:{"text-decoration":"none"},attrs:{href:"#"}},[t("i",{staticClass:"fas fa-user"}),r._v(" Log In")])])]),r._v(" "),t("router-link",{attrs:{to:{name:"register"}}},[t("span",{staticClass:"navbar-text"},[t("a",{staticClass:"btn btn-light action-button",staticStyle:{"border-radius":"50px"},attrs:{role:"button",href:"#"}},[r._v("Signup")])])])],1)])])],1),r._v(" "),t("div",{staticStyle:{"margin-bottom":"66px"}}),r._v(" "),t("router-view")],1)}),[function(){var r=this.$createElement,n=this._self._c||r;return n("button",{staticClass:"navbar-toggler",attrs:{type:"button","data-toggle":"collapse","data-target":"#navbarSupportedContent","aria-controls":"navbarSupportedContent","aria-expanded":"false","aria-label":"Toggle navigation"}},[n("span",{staticClass:"navbar-toggler-icon"})])},function(){var r=this.$createElement,n=this._self._c||r;return n("li",[n("hr",{staticClass:"dropdown-divider"})])}],!1,null,"99809af6",null).exports},1274:(r,n,t)=>{"use strict";t.r(n),t.d(n,{default:()=>v});var a=t(9669),e=t.n(a),o=t(2091),s=t(4343);const i={name:"dashboard",components:{HeaderComponent:o.Z,FooterComponent:s.Z},data:function(){return{loading:!0,sync_id:"",posts:""}},mounted:function(){var r=this;""!==this.$store.state.token?e().get("/api/auth/user-profile/",{headers:{"Content-Type":"application/json",Authorization:"Bearer "+this.$store.state.token}}).then((function(r){})).catch((function(n){r.$store.commit("clearToken"),r.$router.push("/learning/login")})):(this.loading=!1,this.$router.push("/learning/login")),this.my_subject_leasson(),this.findsync_id()},methods:{findsync_id:function(){var r=this;e().get("/api/data_add_lessons/"+this.$route.params.id).then((function(n){r.sync_id=n.data[0],r.loading=!1})).catch((function(n){r.error="Error!!"}))},my_subject_leasson:function(){var r=this;e().get("/api/subject_id").then((function(n){for(var t=0;t<n.data.length;t++)n.data[t].id==r.$route.params.id&&(r.posts={subjectName:n.data[t].subjectName})})).catch((function(r){console.log(r)}))}}};var l=t(3379),d=t.n(l),c=t(2851),A={insert:"head",singleton:!1};d()(c.Z,A);c.Z.locals;const v=(0,t(1900).Z)(i,(function(){var r=this,n=r.$createElement,t=r._self._c||n;return t("div",{attrs:{id:"main"}},[t("div",{attrs:{id:"header"}},[t("HeaderComponent")],1),r._v(" "),t("div",{staticClass:"container",attrs:{id:"content"}},[this.loading?t("div",{staticClass:"d-flex align-items-center container"},[t("strong",[r._v("Loading...")]),r._v(" "),t("div",{staticClass:"spinner-border ms-auto",attrs:{role:"status","aria-hidden":"true"}})]):t("div",[t("div",[t("h4",[r._v("วิชา "+r._s(r.posts.subjectName)+" !")]),r._v(" "),t("hr")])])]),r._v(" "),t("div",{staticClass:"footer",attrs:{id:"footer"}},[t("FooterComponent")],1)])}),[],!1,null,"dd0b747a",null).exports}}]);
//# sourceMappingURL=274.js.map