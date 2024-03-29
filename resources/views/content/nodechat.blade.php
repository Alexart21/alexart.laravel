<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Mongo Chat App</title>
    <link rel="stylesheet" href="css/bootstrap5.min.css" />
    <style>
        #messages {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #222;
            padding: 1em;
        }
        .card-block{
            display: flex;
            justify-content: flex-end;
            flex-direction: column-reverse;
        }
    </style>
</head>
<body>
<div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3 col-sm-12">
          <h1 class="text-center">Mongo Chat</h1>
          <div id="status" style="color: red; height: 2em"></div>
          <div id="chat">
            <input
              type="text"
              id="username"
              class="form-control"
              placeholder="Введите имя"
            />
            Цвет <input type="color" id="color" />
            <br />
            <div class="card">
              <div id="messages" class="card-block"></div>
            </div>
            <br />
            отправвка Ctrl + Enter
            <textarea
              id="textarea"
              class="form-control"
              placeholder="Введите текст"
            ></textarea>
            <button id="send" class="btn btn-success">Отправить</button>
            <br />
            <input id="soundCheck" type="checkbox" checked />Звук
            <button id="clear" class="btn btn-danger">
              Удалить мои сообщения
            </button>
            <button id="clearMsgs" class="btn btn-danger">Очистить чат</button>
            <button id="getMyMsgs" class="btn btn-success">
              Показать мои сообщения
            </button>
            <button id="refresh" class="btn btn-success">Показать все</button>
          </div>
        </div>
      </div>
    </div>
<script src="js/socket.io.js"></script>
<script>
      (function () {
        let element = function (id) {
          return document.getElementById(id);
        };

        // Get Elements
        let status = element("status");
        let messages = element("messages");
        let textarea = element("textarea");
        let username = element("username");
        let color = element("color");
        let send = element("send");
        let clear = element("clear");
        let clearMsgs = element("clearMsgs");
        let getMyMsgs = element("getMyMsgs");
        let refresh = element("refresh");

        // Set default status
        let statusDefault = status.textContent;

        let setStatus = function (s) {
          // Set status
          status.textContent = s;

          if (s !== statusDefault) {
            let delay = setTimeout(function () {
              setStatus(statusDefault);
            }, 4000);
          }
        };
        // Connect to socket.io
        let socket = io.connect("http://localhost:4000");
        const snd = new Audio(
          "data:audio/mpeg;base64,//uQxAAAEvGLIVT0AAuBtax3P2QCIAAIAGWUC+HkqfLeTs0zTQg7wL4BGCfQQ3A1BYDjCA4BoHgpWlFh2Lu+QLnkCgpRYu+4uL2QDQPDIT0FBQyRQUpwbh+fo7i4uLvoKA3BufBAoYlehAoKClOKChiIlbigokli4u8O4u73oh7v/6PcIKChlC6J//1vcEChhYNAaGU7u717u78PoZRYdnkALgvHkClOe/ARmPZVAwGIyHA4FQkCQJBAMAHAEzABwATHDWRgjAHQYFwJEe8X1jOkkG4y04RCJQANqNrMDJKMgDIMDRFDAxXiDAy/CIAwrhVUWkuBgVCABqvXuBybuyBzvSGtzQraTgYJkCgaaxbgYrAVAaNjqAZCANLHNWvS4GC0E4GQARAAgNQMHYCwspBusxOtr/DbAs2Q4tCcxlxZZ5qpw//nS+WTcwPjkEQ/qf/m9y4aLD4xY0FCM/1vr/+DY2I0QIoLjKBoVwKACAwIAAAUBGWCCBZIDYgy509qN0uj/1/Pc3uTBLf/LAI423K5bICDMzK72SSB0piCDVSm//uSxAoDzHSZNbzGADAAADSAAAAEJz44gRLSUSRJEVS0SgAhJcOjJdZkxJsZJBqIqloyMjISTExMTExPVtWTkSRJMXWjISls2t81WrfqtqMBoOCJ4Kgqs6Ij3/8t/g1///ywcLVMQU1FMy45OC40VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVUxBTUUzLjk4LjRVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVf/7ksQ5A8AAAaQAAAAgAAA0gAAABFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVMQU1FMy45OC40VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVX/+5LEOQPAAAGkAAAAIAAANIAAAARVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV"
        );
        //
        function updateMsgs(data) {
          if (data.length) {
            for (let x = 0; x < data.length; x++) {
              // Build out message div
              let message = document.createElement("div");
              message.setAttribute("class", "chat-message");
              message.innerHTML =
                "<small>" +
                formatDate(data[x].dt) +
                "</small>" +
                ' <b style="color:' +
                data[x].color +
                '">' +
                data[x].name +
                "</b>: " +
                data[x].message;
              messages.appendChild(message);
              messages.insertBefore(message, messages.firstChild);
            }
            let soundCheck = document.getElementById("soundCheck").checked;
            if (soundCheck) {
              snd.play();
            }
          }
        }
        function formatDate(dt) {
          if (dt) {
            /*
            let dtArr = dt.split(",");
            let date = dtArr[0];
            let time = dtArr[1].slice(1, 6);
            if (new Date().toLocaleDateString() === date) {
              // сеголняшняя дата-показываем только время
              return time;
            } else {
              return date;
            }
            */

            // время без секунд вида 07:48
            return new Date(dt).toLocaleTimeString().slice(0, -3);
          } else {
            return "";
          }
        }
        // Check for connection
        if (socket !== undefined) {
          console.log("Connected to socket...");

          //Handle Output
          socket.on("output", (data) => {
            // console.log(data);
            updateMsgs(data);
          });

          // Get status from server
          socket.on("status", function (data) {
            // get message status
            setStatus(typeof data === "object" ? data.message : data);

            // If status is clear, clear text
            if (data.clear) {
              textarea.value = "";
            }
          });

          // Handle Input
          // send (duplicate Ctrl + Enter)
          send.addEventListener("click", () => {
            socket.emit("input", {
              name: username.value,
              message: textarea.value,
              color: color.value,
            });
          });
          //
          textarea.addEventListener("keydown", (e) => {
            if (e.keyCode === 13 && e.ctrlKey) {
              // Emit to server input
              socket.emit("input", {
                name: username.value,
                message: textarea.value,
                color: color.value,
              });

              e.preventDefault();
            }
          });

          // Handle Chat Clear
          clear.addEventListener("click", function () {
            if (username.value) {
              socket.emit("clear", {
                name: username.value,
                clear: true,
              });
              messages.textContent = "";
              socket.emit("refresh");
            }
          });

          // очистка окна чата
          clearMsgs.addEventListener("click", function () {
            messages.innerHTML = "";
          });

          // refresh
          refresh.addEventListener("click", function () {
            messages.textContent = "";
            socket.emit("refresh");
          });

          // Clear message
          socket.on("cleared", () => {
            messages.textContent = "";
          });

          // вывести только свои сообщения
          getMyMsgs.addEventListener("click", () => {
            if (username.value) {
              messages.innerHTML = "";
              socket.emit("getMyMsgs", {
                name: username.value,
              });
            }
          });
        }
      })();
      // доставание cookie
      function readCookie(name) {
        const matches = document.cookie.match(
          new RegExp(
            "(?:^|; )" +
              name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
              "=([^;]*)"
          )
        );
        return matches ? decodeURIComponent(matches[1]) : undefined;
      }
    </script>
</body>
</html>

