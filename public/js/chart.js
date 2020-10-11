// window.chartColors = {
// 	red: 'rgb(255, 99, 132)',
// 	orange: 'rgb(255, 159, 64)',
// 	yellow: 'rgb(255, 205, 86)',
// 	green: 'rgb(75, 192, 192)',
// 	blue: 'rgb(54, 162, 235)',
// 	purple: 'rgb(153, 102, 255)',
// 	grey: 'rgb(201, 203, 207)'
// };
// var COLORS = [
//     '#4dc9f6',
//     '#f67019',
//     '#f53794',
//     '#537bc4',
//     '#acc236',
//     '#166a8f',
//     '#00a950',
//     '#58595b',
//     '#8549ba'
// ];
// var ctx1 = document.getElementById('myChart').getContext('2d');
// var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
// var myChart = new Chart(ctx1, {
//     type:'line',
//     data: {
//         labels:MONTHS,
//         datasets:[{
//             label:'',
//             borderColor: window.chartColors.green,
//             backgroundColor: window.chartColors.red,
//             data:[
//                 3,5,8,12,45,3,9,1,4,12,45
//             ]
//         }]
//     },
//     options: {
//         responsive: true,
//         title: {
//             display: true,
//             text: 'Solicitudes Recibidas por mes en el año corriente'
//         },
//         tooltips: {
//             mode: 'index',
//         },
//         hover: {
//             mode: 'index'
//         },
//         scales: {
//             xAxes: [{
//                 scaleLabel: {
//                     display: true,
//                     labelString: 'Month'
//                 }
//             }],
//             yAxes: [{
//                 stacked: true,
//                 scaleLabel: {
//                     display: true,
//                     labelString: 'Value'
//                 }
//             }]
//         }
//     }
// });
// var mode      = 'index';
// var intersect = true;
// var ticksStyle = {
//     fontColor: '#495057',
//     fontStyle: 'bold'
//   };
// var ctx2 = document.getElementById('myChart1').getContext('2d');
// var myChart = new Chart(ctx2, {
//     type:'bar',
//     data: {
//         labels:MONTHS,
//         datasets:[{
//                 label:'',
//                 type                : 'line',
//                 data                : [3,5,8,12,45,3,9,1,4,12,45],
//                 backgroundColor     : 'transparent',
//                 borderColor         : '#007bff',
//                 pointBorderColor    : '#007bff',
//                 pointBackgroundColor: '#007bff',
//                 fill                : false
//             }
//         ]
//     },
//     options: {
//         responsive: true,
//         title: {
//             display: true,
//             text: 'Solicitudes Recibidas por mes en el año corriente'
//         },
//         tooltips: {
//             mode: 'index',
//         },
//         hover: {
//             mode: 'index'
//         },
//         scales             : {
//             xAxes: [{
//                 scaleLabel: {
//                     display: true,
//                     labelString: 'Month'
//                 }
//             }],
//             yAxes: [{
//                 stacked: true,
//                 scaleLabel: {
//                     display: true,
//                     labelString: 'Value'
//                 }
//             }]
//         }
//       }
// });