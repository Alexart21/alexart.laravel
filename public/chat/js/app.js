(()=>{"use strict";var V={1468:(V,e,t)=>{t(6992),t(8674),t(9601),t(7727);var n=t(5010),r=(t(8309),t(3396)),a=t(7139),s=function(V){return(0,r.dD)("data-v-23cef8ab"),V=V(),(0,r.Cn)(),V},o={class:"container"},c=s((function(){return(0,r._)("h1",null,"Vue 3 && Mysql chat used setInterval",-1)})),u={class:"chat-window",ref:"chat"},l={class:"small"},i=s((function(){return(0,r._)("br",null,null,-1)})),m=s((function(){return(0,r._)("small",null,"отправка кнопкой или Ctrl + Enter",-1)})),f={class:"msg-block"},d=["disabled"];function h(V,e,t,s,h,p){var A=(0,r.up)("mdicon");return(0,r.wg)(),(0,r.iD)("div",o,[c,(0,r._)("div",u,[h.allMsgs.length?((0,r.wg)(!0),(0,r.iD)(r.HY,{key:0},(0,r.Ko)(h.allMsgs,(function(V){return(0,r.wg)(),(0,r.iD)("div",{key:V.id},[(0,r._)("small",l,(0,a.zw)(p.formatTime(V.created_at)),1),(0,r.Uk)("  "),(0,r._)("b",{class:"name",style:(0,a.j5)({color:V.color})},(0,a.zw)(V.name)+" : ",5),(0,r._)("span",null,(0,a.zw)(V.msg),1)])})),128)):(0,r.kq)("",!0)],512),(0,r._)("form",{ref:"chatForm",action:"",onSubmit:e[10]||(e[10]=(0,n.iM)((function(){return p.formSend&&p.formSend.apply(p,arguments)}),["prevent"]))},[h.nameStatus?((0,r.wg)(),(0,r.iD)("div",{key:0,style:(0,a.j5)({color:h.nameChecked?"#222":"red"})},(0,a.zw)(h.nameStatus),5)):(0,r.kq)("",!0),(0,r.wy)((0,r._)("input",{class:"name-inp",style:(0,a.j5)({color:h.color}),type:"text",name:"name","onUpdate:modelValue":e[0]||(e[0]=function(V){return h.name=V}),placeholder:"имя",onInput:e[1]||(e[1]=function(){return p.checkName&&p.checkName.apply(p,arguments)})},null,36),[[n.nr,h.name]]),(0,r.Uk)("   "),(0,r.wy)((0,r._)("input",{type:"color","onUpdate:modelValue":e[2]||(e[2]=function(V){return h.color=V}),onInput:e[3]||(e[3]=function(){return p.setColor&&p.setColor.apply(p,arguments)})},null,544),[[n.nr,h.color]]),(0,r._)("button",{onClick:e[4]||(e[4]=function(){return p.sendName&&p.sendName.apply(p,arguments)}),class:"btn btn-primary"},"Установить"),i,m,(0,r._)("div",f,[(0,r.wy)((0,r._)("textarea",{onKeydown:e[5]||(e[5]=(0,n.D2)((0,n.iM)((function(){return p.formSend&&p.formSend.apply(p,arguments)}),["ctrl"]),["enter"])),class:"msg-inp",type:"text",name:"msg","onUpdate:modelValue":e[6]||(e[6]=function(V){return h.msg=V}),placeholder:"текст",rows:"2"},"\r\n      ",544),[[n.nr,h.msg]]),(0,r._)("button",{type:"submit",disabled:h.disabled,class:"msg-send"},[(0,r.Wm)(A,{name:"send",width:"40",height:"40",class:"send-icon"})],8,d)]),(0,r._)("button",{onClick:e[7]||(e[7]=function(){return p.clear&&p.clear.apply(p,arguments)}),type:"button",class:"btn btn-warning"}," Очистить чат "),(0,r.wy)((0,r._)("input",{type:"checkbox","onUpdate:modelValue":e[8]||(e[8]=function(V){return h.soundCheck=V})},null,512),[[n.e8,h.soundCheck]]),(0,r.Uk)("Звук "),(0,r.wy)((0,r._)("input",{type:"checkbox","onUpdate:modelValue":e[9]||(e[9]=function(V){return h.fullDate=V})},null,512),[[n.e8,h.fullDate]]),(0,r.Uk)("Показывать дату ")],544)])}var p=t(5082),A=t(124),g=t(9584),v=t(8534),C=(t(6699),t(2023),t(1539),t(7658),t(5069),t(2564),t(1249),t(65));const k={data:function(){return{name:"",msg:"",color:"",names:[],lastId:0,soundCheck:!0,fullDate:!1,snd:new Audio("data:audio/mpeg;base64,//uQxAAAEvGLIVT0AAuBtax3P2QCIAAIAGWUC+HkqfLeTs0zTQg7wL4BGCfQQ3A1BYDjCA4BoHgpWlFh2Lu+QLnkCgpRYu+4uL2QDQPDIT0FBQyRQUpwbh+fo7i4uLvoKA3BufBAoYlehAoKClOKChiIlbigokli4u8O4u73oh7v/6PcIKChlC6J//1vcEChhYNAaGU7u717u78PoZRYdnkALgvHkClOe/ARmPZVAwGIyHA4FQkCQJBAMAHAEzABwATHDWRgjAHQYFwJEe8X1jOkkG4y04RCJQANqNrMDJKMgDIMDRFDAxXiDAy/CIAwrhVUWkuBgVCABqvXuBybuyBzvSGtzQraTgYJkCgaaxbgYrAVAaNjqAZCANLHNWvS4GC0E4GQARAAgNQMHYCwspBusxOtr/DbAs2Q4tCcxlxZZ5qpw//nS+WTcwPjkEQ/qf/m9y4aLD4xY0FCM/1vr/+DY2I0QIoLjKBoVwKACAwIAAAUBGWCCBZIDYgy509qN0uj/1/Pc3uTBLf/LAI423K5bICDMzK72SSB0piCDVSm//uSxAoDzHSZNbzGADAAADSAAAAEJz44gRLSUSRJEVS0SgAhJcOjJdZkxJsZJBqIqloyMjISTExMTExPVtWTkSRJMXWjISls2t81WrfqtqMBoOCJ4Kgqs6Ij3/8t/g1///ywcLVMQU1FMy45OC40VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVUxBTUUzLjk4LjRVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVf/7ksQ5A8AAAaQAAAAgAAA0gAAABFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVMQU1FMy45OC40VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVX/+5LEOQPAAAGkAAAAIAAANIAAAARVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV"),allMsgs:[],disabled:!1,nameStatus:"Введите имя и нажмите установить",nameChecked:!1,success:!0}},methods:{formatTime:function(V){var e=V.substring(11,16),t=V.substring(0,16);return this.fullDate?t:e},setColor:function(){localStorage.setItem("nameColor",this.color)},checkName:function(){if(this.name.length<3)return this.nameChecked=!1,void(this.nameStatus="Хотя бы 3 символа");this.names.length&&this.names.includes(this.name.toLowerCase())?(this.nameChecked=!1,this.nameStatus="Это имя уже используется.Выберите другое"):(this.nameChecked=!0,this.nameStatus='Имя свободно. Жмите "Установить"')},sendName:function(){this.checkName(),this.nameChecked&&(localStorage.setItem("nickName",this.name),this.setColor(),this.nameStatus="Имя установлено")},clear:function(){this.allMsgs=[]},scrollToBottom:function(){this.$refs.chat.scrollTop=1e10},all:function(){var V=this;return(0,v.Z)((0,A.Z)().mark((function e(){var t;return(0,A.Z)().wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t="/vchat/all",e.next=3,fetch(t).then((function(V){return V.json()})).then((function(e){if(e.success&&e.msgs.length){var t;V.lastId=e.lastId,(t=V.allMsgs).push.apply(t,(0,g.Z)(e.msgs)),V.allMsgs.reverse(),setTimeout(V.scrollToBottom,300);var n=V.name.toLowerCase();V.allMsgs.map((function(e){var t=e.name.toLowerCase();V.names.includes(t)||t===n||V.names.push(t)}))}}))["catch"]((function(V){return console.log("error",V)}));case 3:case"end":return e.stop()}}),e)})))()},formSend:function(){var V=this;return(0,v.Z)((0,A.Z)().mark((function e(){var t,n;return(0,A.Z)().wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(V.name&&V.msg){e.next=2;break}return e.abrupt("return");case 2:if(V.nameChecked){e.next=5;break}return V.nameStatus="Установите имя",e.abrupt("return");case 5:return V.disabled=!0,t="/vchat/store",n=new FormData,n.append("name",V.name),n.append("msg",V.msg),n.append("color",V.color),n.append("_token",V.csrf),e.next=14,fetch(t,{method:"POST",body:n}).then((function(V){return V.json()})).then((function(e){e.success&&e.id&&(V.update(),V.msg="")}))["catch"]((function(V){return console.log("error",V)}));case 14:V.disabled=!1;case 15:case"end":return e.stop()}}),e)})))()},update:function(){var V=this;return(0,v.Z)((0,A.Z)().mark((function e(){var t;return(0,A.Z)().wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t="/vchat/update?id="+V.lastId,e.next=3,fetch(t).then((function(V){return V.json()})).then((function(e){if(e.success&&e.msgs.length){var t;V.lastId=e.lastId,(t=V.allMsgs).push.apply(t,(0,g.Z)(e.msgs));var n=V.name.toLowerCase();V.allMsgs.map((function(e){var t=e.name.toLowerCase();V.names.includes(t)||t===n||V.names.push(t)})),V.scrollToBottom(),V.soundCheck&&V.snd.play()}}))["catch"]((function(V){return console.log("error",V)}));case 3:case"end":return e.stop()}}),e)})))()},tick:function(){var V=this;setInterval((function(){return V.update()}),5e3)},initName:function(){var V;this.name=null!==(V=localStorage.getItem("nickName"))&&void 0!==V?V:""},initColor:function(){var V;this.color=null!==(V=localStorage.getItem("nameColor"))&&void 0!==V?V:"#000000"}},computed:(0,p.Z)({},(0,C.Se)(["csrf"])),mounted:function(){this.initName(),this.initColor(),this.all(),this.scrollToBottom(),this.tick()}};var w=t(89);const b=(0,w.Z)(k,[["render",h],["__scopeId","data-v-23cef8ab"]]),y=b;var S={state:{csrf:""},getters:{csrf:function(V){return V.csrf}},mutations:{setCsrf:function(V,e){V.csrf=e.csrf}},actions:{loadCsrf:function(V){return(0,v.Z)((0,A.Z)().mark((function e(){var t,n,r;return(0,A.Z)().wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t=V.commit,n="/csrf",e.next=4,fetch(n);case 4:return r=e.sent,e.next=7,r.json();case 7:r=e.sent,t("setCsrf",r);case 9:case"end":return e.stop()}}),e)})))()}},strict:!1};const I=(0,C.MT)(S);var x=t(9793),D=t(6526);(0,n.ri)(y).use(I).use(x.Z,{icons:{mdiSend:D.NN1}}).mount("#app"),I.dispatch("loadCsrf")}},e={};function t(n){var r=e[n];if(void 0!==r)return r.exports;var a=e[n]={exports:{}};return V[n](a,a.exports,t),a.exports}t.m=V,(()=>{var V=[];t.O=(e,n,r,a)=>{if(!n){var s=1/0;for(l=0;l<V.length;l++){for(var[n,r,a]=V[l],o=!0,c=0;c<n.length;c++)(!1&a||s>=a)&&Object.keys(t.O).every((V=>t.O[V](n[c])))?n.splice(c--,1):(o=!1,a<s&&(s=a));if(o){V.splice(l--,1);var u=r();void 0!==u&&(e=u)}}return e}a=a||0;for(var l=V.length;l>0&&V[l-1][2]>a;l--)V[l]=V[l-1];V[l]=[n,r,a]}})(),(()=>{t.n=V=>{var e=V&&V.__esModule?()=>V["default"]:()=>V;return t.d(e,{a:e}),e}})(),(()=>{t.d=(V,e)=>{for(var n in e)t.o(e,n)&&!t.o(V,n)&&Object.defineProperty(V,n,{enumerable:!0,get:e[n]})}})(),(()=>{t.g=function(){if("object"===typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(V){if("object"===typeof window)return window}}()})(),(()=>{t.o=(V,e)=>Object.prototype.hasOwnProperty.call(V,e)})(),(()=>{var V={143:0};t.O.j=e=>0===V[e];var e=(e,n)=>{var r,a,[s,o,c]=n,u=0;if(s.some((e=>0!==V[e]))){for(r in o)t.o(o,r)&&(t.m[r]=o[r]);if(c)var l=c(t)}for(e&&e(n);u<s.length;u++)a=s[u],t.o(V,a)&&V[a]&&V[a][0](),V[a]=0;return t.O(l)},n=self["webpackChunkspa_vue"]=self["webpackChunkspa_vue"]||[];n.forEach(e.bind(null,0)),n.push=e.bind(null,n.push.bind(n))})();var n=t.O(void 0,[998],(()=>t(1468)));n=t.O(n)})();