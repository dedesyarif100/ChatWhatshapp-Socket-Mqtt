let mqtt = require('mqtt');
let host = 'monstercode.ip-dynamic.com';
let port = 9001;
let protocol = 'mqtt://';
let fullHost = `${protocol}${host}:${port}`;
window.client = null;
window.mqttUserKey = '';
// window.mqttOnMessage = () => {
//     alert('tes 1');
// };
// window.topic = 'tes topic';
let baseTopic = '/wa/';
const option = {
    username: 'monster_sby',
    password: 'P@ssw0rd'
}

client = mqtt.connect(fullHost, option);

console.log(window.topic);

client.on('connect', (connect) => {
    console.log('Connected');
    client.subscribe(`${baseTopic}#`);
});

client.on('disconnect', (packet) => {
    console.log('disconnect');
});

client.on('error', (params) => {
    console.log('Error', params)
});

client.on('message', function (topic, message) {
    console.log(topic);
    console.log(message.toString());
    console.log(mqttUserKey);
    window.mqttOnMessage(topic, message, mqttUserKey);
});
