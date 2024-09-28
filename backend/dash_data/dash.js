/* chart.js chart examples */


// chart colors
var colors = ['#f8bbd0','#d0d9ff','#d0d9ff','#d0d9ff','#dc3545','#6c757d'];

/* large line chart */
var chLine = document.getElementById("chLine");
var chartData = {
  labels: ["06.00", "09.00", "12.00", "15.00", "18.00", "21.00", "00.00", "01.00", "03.00"],
  datasets: 
  [{
    data: [639, 65, 93, 78, 589, 632, 74],
    backgroundColor: 'transparent',
    borderColor: colors[0],
    borderWidth: 4,
    pointBackgroundColor: colors[0]
  },
  {
    data: [639, 465, 493, 78, 589, 32, 74],
    backgroundColor: colors[3],
    borderColor: colors[1],
    borderWidth: 4,
    pointBackgroundColor: colors[1]
  }
  ]
};
if (chLine) {
  new Chart(chLine, {
  type: 'line',
  data: chartData,
  options: {
    scales: {
      xAxes: [{
        ticks: {
          beginAtZero: false
        }
      }]
    },
    legend: {
      display: false
    },
    responsive: true
  }
  });
}

/* large pie/donut chart */
var chPie = document.getElementById("chPie");
if (chPie) {
  new Chart(chPie, {
    type: 'pie',
    data: {
      labels: ['Desktop', 'Phone', 'Tablet', 'Unknown'],
      datasets: [
        {
          backgroundColor: [colors[1],colors[0],colors[2],colors[5]],
          borderWidth: 0,
          data: [50, 40, 15, 5]
        }
      ]
    },
    plugins: [{
      beforeDraw: function(chart) {
        var width = chart.chart.width,
            height = chart.chart.height,
            ctx = chart.chart.ctx;
        ctx.restore();
        var fontSize = (height / 70).toFixed(2);
        ctx.font = fontSize + "em sans-serif";
        ctx.textBaseline = "middle";
        var text = chart.config.data.datasets[0].data[0] + "%",
            textX = Math.round((width - ctx.measureText(text).width) / 2),
            textY = height / 2;
        ctx.fillText(text, textX, textY);
        ctx.save();
      }
    }],
    options: {layout:{padding:0}, legend:{display:false}, cutoutPercentage: 80}
  });
}

/* bar chart */
var chBar = document.getElementById("chBar");
if (chBar) {
  new Chart(chBar, {
  type: 'bar',
  data: {
    labels: ["S", "M", "T", "W", "T", "F", "S"],
    datasets: [{
      data: [589, 445, 483, 503, 689, 692, 634],
      backgroundColor: colors[0]
    },
    {
      data: [639, 465, 493, 478, 589, 632, 674],
      backgroundColor: colors[1]
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        barPercentage: 0.4,
        categoryPercentage: 0.5
      }]
    }
  }
  });
}

var chBar = document.getElementById("chBar1");
if (chBar) {
  new Chart(chBar, {
  type: 'bar',
  data: {
    labels: ["S", "M", "T", "W", "T", "F", "S"],
    datasets: [{
      data: [589, 445, 483, 503, 689, 692, 634],
      backgroundColor: colors[0]
    },
    {
      data: [639, 465, 493, 478, 589, 632, 674],
      backgroundColor: colors[1]
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        barPercentage: 0.4,
        categoryPercentage: 0.5
      }]
    }
  }
  });
}

/* 3 donut charts */
var donutOptions = {
  cutoutPercentage: 100, 
  legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
};

// donut 1
var chDonutData1 = {
    labels: [ 'จำนวนการจองทั้งหมด'],
    datasets: [
      {
        backgroundColor: colors.slice(0,2),
        borderWidth: 0,
        data: [70, 30]
      }
    ]
};

var chDonut1 = document.getElementById("chDonut1");
if (chDonut1) {
  new Chart(chDonut1, {
      type: 'doughnut',
      data: chDonutData1,
      options: donutOptions
  });
}

// donut 2
var donutOptions = {
  cutoutPercentage: 100, 
  legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
};

// donut 1
var chDonutData2 = {
    labels: [ 'จำนวนการจองทั้งหมด'],
    datasets: [
      {
        backgroundColor: colors.slice(0,2),
        borderWidth: 0,
        data: [70, 30]
      }
    ]
};

var chDonut2 = document.getElementById("chDonut2");
if (chDonut2) {
  new Chart(chDonut2, {
      type: 'doughnut',
      data: chDonutData2,
      options: donutOptions
  });
}
// donut 3
var donutOptions = {
  cutoutPercentage: 100, 
  legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
};

// donut 1
var chDonutData3 = {
    labels: [ 'จำนวนการจองทั้งหมด'],
    datasets: [
      {
        backgroundColor: colors.slice(0,2),
        borderWidth: 0,
        data: [70, 30]
      }
    ]
};

var chDonut3 = document.getElementById("chDonut3");
if (chDonut3) {
  new Chart(chDonut3, {
      type: 'doughnut',
      data: chDonutData3,
      options: donutOptions
  });
}

/* 3 line charts */
var lineOptions = {
    legend:{display:false},
    tooltips:{interest:false,bodyFontSize:11,titleFontSize:11},
    scales:{
        xAxes:[
            {
                ticks:{
                    display:false
                },
                gridLines: {
                    display:false,
                    drawBorder:false
                }
            }
        ],
        yAxes:[{display:false}]
    },
    layout: {
        padding: {
            left: 6,
            right: 6,
            top: 4,
            bottom: 6
        }
    }
};

var chLine1 = document.getElementById("chLine1");
if (chLine1) {
  new Chart(chLine1, {
      type: 'line',
      data: {
          labels: ['Jan','Feb','Mar','Apr','May'],
          datasets: [
            {
              backgroundColor:'#ffffff',
              borderColor:'#ffffff',
              data: [10, 11, 4, 11, 4],
              fill: false
            }
          ]
      },
      options: lineOptions
  });
}
var chLine2 = document.getElementById("chLine2");
if (chLine2) {
  new Chart(chLine2, {
      type: 'line',
      data: {
          labels: ['A','B','C','D','E'],
          datasets: [
            {
              backgroundColor:'#ffffff',
              borderColor:'#ffffff',
              data: [4, 5, 7, 13, 12],
              fill: false
            }
          ]
      },
      options: lineOptions
  });
}

var chLine3 = document.getElementById("chLine3");
if (chLine3) {
  new Chart(chLine3, {
      type: 'line',
      data: {
          labels: ['Pos','Neg','Nue','Other','Unknown'],
          datasets: [
            {
              backgroundColor:'#ffffff',
              borderColor:'#ffffff',
              data: [13, 15, 10, 9, 14],
              fill: false
            }
          ]
      },
      options: lineOptions
  });
}