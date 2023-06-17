$(function () {
  'use strict';
  var inventories = JSON.parse(document.getElementById('pieChart').getAttribute('inventories'));

  var soldCount = 0;
  var notSoldCount = 0;
  inventories.forEach(function (inventory) {
    if (inventory.sold === 1) {
      soldCount++;
    } else {
      notSoldCount++;
    }
  });

  var doughnutPieData = {
    datasets: [{
      data: [soldCount, notSoldCount],
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.5)',
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
      ],
    }],
    labels: [
      'Sold',
      'Not Sold',
    ]
  };

  var doughnutPieOptions = {
    responsive: true,
    animation: {
      animateScale: true,
      animateRotate: true
    }
  };

  var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas, {
    type: 'pie',
    data: doughnutPieData,
    options: doughnutPieOptions
  });
});
