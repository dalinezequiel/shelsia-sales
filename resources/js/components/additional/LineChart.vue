<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [{
            label: 'Sales',
            data: [12, 19, 3, 5, 2, 3, 14],
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
</script>
<template>
    <div class="container mx-auto px-4 py-8 mt-16">
        <canvas id="myChart"></canvas>
    </div>
</template>