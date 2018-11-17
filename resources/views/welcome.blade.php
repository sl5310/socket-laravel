<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font: 13px Helvetica, Arial; }
        form { background: #000; padding: 3px; position: fixed; bottom: 0; width: 100%; }
        form input { border: 0; padding: 10px; width: 90%; margin-right: .5%; }
        form button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }
        #messages { list-style-type: none; margin: 0; padding: 0; }
        #messages li { padding: 5px 10px; }
        #messages li:nth-child(odd) { background: #eee; }
    </style>
</head>

<body>
<div id="chat">
    <ul>
        <li v-for="message in messages">
            @{{ message }}
        </li>
    </ul>
    <form v-on:submit.prevent="send">
    <input v-model="message">
    <button>Send</button>
    </form>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>
  new Vue({
    el: '#chat',
    data: {
      messages: [],
      message: ''
    },
    mounted: function() {
      socket.on('chat.message', function(message) {
        this.messages.push(message);
      }.bind(this));
    },
    methods: {
      send: function(e) {
        socket.emit('chat.message', this.message);
        this.message = '';
      }
    }
  })
    </script>
</body>
</html>