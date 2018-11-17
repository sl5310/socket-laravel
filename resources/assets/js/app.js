window.Vue = require('vue/dist/vue.js');
window.axios = require('axios');

var io = require('socket.io-client');
var socket = io.connect('http://localhost:3000');
window.socket = socket;
