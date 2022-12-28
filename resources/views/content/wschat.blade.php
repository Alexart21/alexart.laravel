<html>
<head>
    <title>Laravel WebSockets Chat Example</title>
{{--    <script src="js/jquery.min.js"></script>--}}
    <script src="js/pusher.min.js"></script>
    <script src="js/vue2.6.14.min.js"></script>
    <link href="css/bootstrap5.min.css" rel="stylesheet">
{{--    <script src="js/bootstrap.bundle.min.js"></script>--}}
    <style>
        .chat{
            max-height: 400px;
            overflow: hidden;
            overflow-y: scroll;
        }
    </style>
</head>

<body>
<div class="container" id="app">
    <br>
    <br>
    <p class="text-center p-0 m-0">Laravel WebSockets</p>
    <h1 class="text-center p-0 m-0">Chat App Example</h1>
    <p class="text-center "><a href="https://ahtcloud.com">By AHT Cloud | Emad Zaamout</a></p>
    <div class="card mt-4">
        <div class="card-header p-2">
            <form>
                <div class="col-lg-2 col-md-3 col-sm-12 mt-2 p-0">
                    <label>Name</label>
                    <input class="form-control form-control-sm" placeholder="Name" v-model="name">
                </div>
                <div class="col-lg-1 col-md-2 col-sm-12 mt-2 p-0">
                    <button v-if="connected === false" v-on:click="connect()" type="button"
                            class="mr-2 btn btn-sm btn-primary w-100">
                        Connect
                    </button>
                    <button v-if="connected === true" v-on:click="disconnect()" type="button"
                            class="mr-2 btn btn-sm btn-danger w-100">
                        Disconnect
                    </button>
                </div>
            </form>
            <div>
                <p>Channels current state is @{{ state }}</p>
            </div>
        </div>
        <div v-if="connected === true" class="card-body">

            <div class="col-12 bg-light pt-2 pb-2 mt-3 chat">
                <p class="p-0 m-0 ps-2 pe-2" v-for="(message, index) in incomingMessages">
                    @{{ message.time }} <b style="font-size: 120%;">@{{ message.name }}</b>
                    @{{ message.message }}
                </p>
            </div>

            <h4 class="mt-4">Message</h4>
            <form>
                <div class="row mt-2">
                    <div class="col-12 text-white" v-show="formError === true">
                        <div class="bg-danger p-2 mb-2">
                            <p class="p-0 m-0"><b>Error:</b> Invalid message.</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <textarea v-model="message" placeholder="Your message ..." class="form-control"
                                      rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row text-right mt-2">
                    <div class="col-lg-10">

                    </div>
                    <div v-show="sending">отправка...</div>
                    <div class="d-flex">
                        <button type="button" v-on:click="sendMessage()" class="btn btn-small btn-primary">Send
                            Message
                        </button>&nbsp;&nbsp;
                        <button type="button" v-on:click="clearMsgs()" class="btn btn-small btn-warning">Clear chat</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    new Vue({
        "el": "#app",
        "data": {
            connected: false,
            pusher: null,
            app: null,
            apps: {!! json_encode($apps) !!},
            logChannel: "{{ $logChannel }}",
            authEndpoint: "{{ $authEndpoint }}",
            host: "{{ $host }}",
            port: "{{ $port }}",
            state: null,
            message: null,
            name: null,
            // color: 'lime',
            formError: false,
            incomingMessages: [],
            sending: false
        },
        mounted() {
            this.app = this.apps[0] || null;
        },
        methods: {
            connect() {
                this.pusher = new Pusher("staging", {
                    wsHost: this.host,
                    wsPort: this.port,
                    wssPort: this.port,
                    wsPath: this.app.path,
                    disableStats: true,
                    authEndpoint: this.authEndpoint,
                    forceTLS: false,
                    auth: {
                        headers: {
                            "X-CSRF-Token": "{{ csrf_token() }}",
                            "X-App-ID": this.app.id
                        }
                    },
                    enabledTransports: ["ws"]
                });

                this.pusher.connection.bind('state_change', states => {
                    this.state = states.current
                });

                this.pusher.connection.bind('connected', () => {
                    this.connected = true;
                });

                this.pusher.connection.bind('disconnected', () => {
                    this.connected = false;
                });

                this.pusher.connection.bind('error', event => {
                    this.formError = true;
                });

                this.subscribeToAllChannels();
            },
            subscribeToAllChannels() {
                [
                    "api-message",
                ].forEach(channelName => this.subscribeToChannel(channelName));
            },
            subscribeToChannel(channelName) {
                let inst = this;
                this.pusher.subscribe(this.logChannel + channelName)
                    .bind("log-message", (data) => {
                        console.log(data);
                        if (data.type === "api-message") {
                            if (data.details.includes("SendMessageEvent")) {
                                let messageData = JSON.parse(data.data);
                                inst.incomingMessages.push(messageData);
                                this.message = '';
                                this.sending = false;
                            }
                        }
                    });
            },
            disconnect() {
                this.connected = false;
            },
            async sendMessage() {
                this.sending = true;
                this.formError = false;
                if (this.message === "" || this.message === null) {
                    this.formError = true;
                }else{
                    let formData = new FormData();
                    formData.append("name", this.name ?? '');
                    formData.append("message", this.message);
                    formData.append("_token", '{{ csrf_token() }}');
                    await fetch("/chat/send", {
                        method: "POST",
                        /*headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },*/
                        body: formData
                    })
                    .catch(error => {alert("Error sending event.");this.sending = false;})
                }
            },
            clearMsgs(){
               this.incomingMessages = [];
            },
        }
    });
</script>
</body>

</html>
