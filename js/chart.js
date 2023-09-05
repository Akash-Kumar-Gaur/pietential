var ls = [
  "Self Actualization",
  "Esteem and Contribution",
  "Love and Belonging",
  "Safety Needs",
  "Physiological Needs",
];

function drawGraph() {
  var historyData = {
    labels: graphDateList,
    datasets: [
      {
        backgroundColor: "rgba(9,0,0,0.1)",
        borderColor: "rgba(110, 148, 248, 1)",
        data: selfList,
        label: "Self Actualization",
        fill: "-1",
      },
      {
        backgroundColor: "rgba(9,0,0,0.1)",
        borderColor: "rgba(2, 183, 45, 1)",
        data: esteemList,
        label: "Self-Esteem and Contribution",
        fill: "-1",
      },
      {
        backgroundColor: "rgba(9,0,0,0.1)",
        borderColor: "rgba(249, 186, 3, 1)",
        data: belongingList,
        label: "Love and Belonging",
        fill: "-1",
      },
      {
        backgroundColor: "rgba(9,0,0,0.1)",
        borderColor: "rgba(248, 126, 2, 1)",
        data: safetyList,
        label: "Safety Needs",
        fill: "0",
      },
      {
        backgroundColor: "rgba(9,0,0,0.1)",
        borderColor: "rgba(251, 0, 0, 1)",
        data: physiologicalList,
        label: "Physiological Needs",
        fill: "0",
      },
    ],
  };
  var options = {
    maintainAspectRatio: false,
    spanGaps: false,
    elements: {
      line: {
        tension: 0.4,
      },
    },
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: true,
          },
        },
      ],
    },
    plugins: {
      filler: {
        propagate: false,
      },
      "samples-filler-analyser": {
        target: "chart-analyser",
      },
    },
  };
  var chart = new Chart("canvas", {
    type: "line",
    data: historyData,
    options: options,
  });
}

// FOR BAR GRAPH AND FOR POLAR AREA CHART

function drawChart(a, b, c, d, e) {
  sessionStorage.setItem("actualizationScore", a);
  sessionStorage.setItem("esteemScore", b);
  sessionStorage.setItem("belongingScore", c);
  sessionStorage.setItem("needsScore", d);
  sessionStorage.setItem("physiologicalScore", e);
  var part1color = `rgba(110, 148, 248, 1)`; //blue
  var part2color = `rgba(2, 183, 45, 1)`; //green
  var part3color = `rgba(249, 186, 3, 1)`; // yellow
  var part4color = `rgba(248, 126, 2, 1)`; // orange
  var part5color = `rgba(251, 0, 0, 1)`; // red
  var ctx = document.getElementById("myChart").getContext("2d");
  var ctx2 = document.getElementById("barchart").getContext("2d");
  var ls = [
    "Self Actualization",
    "Esteem and Contribution",
    "Love and Belonging",
    "Safety Needs",
    "Physiological Needs",
  ];
  var barchart = new Chart(ctx2, {
    type: "bar",
    data: {
      labels: ls,
      datasets: [
        {
          label: "Your score",
          data: [a, b, c, d, e],
          backgroundColor: [
            part1color,
            part2color,
            part3color,
            part4color,
            part5color,
          ],
          borderColor: [
            part1color,
            part2color,
            part3color,
            part4color,
            part5color,
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      legend: {
        display: false,
      },
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
              max: 100,
            },
          },
        ],
      },
    },
  });
  var myChart = new Chart(ctx, {
    type: "polarArea",
    data: {
      labels: ls,
      datasets: [
        {
          label: "Score",
          data: [a, b, c, d, e],
          backgroundColor: [
            part1color,
            part2color,
            part3color,
            part4color,
            part5color,
          ],
          borderColor: [
            part1color,
            part2color,
            part3color,
            part4color,
            part5color,
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      legend: {
        labels: {
          // This more specific font property overrides the global property
          defaultFontSize: 18,
        },
      },
      scale: {
        display: false,
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              display: false,
            },
            ticks: {
              display: false,
            },
          },
        ],
        yAxes: [
          {
            gridLines: {
              display: false,
            },
            ticks: {
              display: false,
            },
          },
        ],
      },
    },
  });
}
