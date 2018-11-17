var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var axios = require('axios');
const PORT = 3000;

server.listen(PORT, function(){
  console.log('Listening on Port 3000');
});

io.on('connection', function(socket) {

  socket.on('chat.message', function(message) {
    const isProhibited = isSensitiveWords(message);
    if (!isProhibited) {
      io.emit('chat.message', message);
      axios.post('http://socket.test/socket/send', {
        message: message
      })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  });

  socket.on('disconnect', function() {
    io.emit('chat.message', 'User has disconnected.');
  });
});

const isSensitiveWords = function(message) {
  var checkMessage = message.toLowerCase();
  var prohibitedWords = ['sex', 'nude', 'happy'];
  return prohibitedWords.some(function (word) {
    return checkMessage.includes(word);
  });
};