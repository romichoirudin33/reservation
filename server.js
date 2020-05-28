const app = require('express')();
const server = require('http').Server(app);
const io = require('socket.io')(server);

server.listen(3000);
console.log('Open http://localhost:3000');
// WARNING: app.listen(80) will NOT work here!

app.get('/', (req, res) => {
    res.sendFile('/index.html');
});

io.on('connection', (socket) => {

    socket.on('booking', (data) => {
        io.emit('getBooking', data);
    });

    socket.on('payment', (data) => {
        io.emit('getPayment', data);
    });
});