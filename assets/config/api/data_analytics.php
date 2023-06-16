    <script src="./vendor/chartjs/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function(){
        var ctx = $("#weatherChart");
        
        var data = {
          labels: [], //will hold time/date labels
          datasets: [
            {
              label: "Temperature (°C)",
              data: [], //will hold temperature data
              backgroundColor: "rgba(255, 99, 132, 0.2)",
              borderColor: "rgba(255, 99, 132, 1)",
              borderWidth: 1,
              fill: false
            },
            {
              label: "Wind (m/s)",
              data: [], //will hold wind data
              backgroundColor: "rgba(54, 162, 235, 0.2)",
              borderColor: "rgba(54, 162, 235, 1)",
              borderWidth: 1,
              fill: false
            },
            {
              label: "Precipitation (mm)",
              data: [], //will hold precipitation data
              backgroundColor: "rgba(75, 192, 192, 0.2)",
              borderColor: "rgba(75, 192, 192, 1)",
              borderWidth: 1,
              fill: false
            },
            {
                label: "Humidity (%)",
                data: [], //will hold humidity data
                backgroundColor: "rgba(153, 102, 255, 0.2)",
                borderColor: "rgba(153, 102, 255, 1)",
                borderWidth: 1,
                fill: false
                }
          ]
        };
        
        $.ajax({
          url: "https://api.openweathermap.org/data/2.5/forecast?q=Malabon&appid=2d0e03c585429615a8d44cfd9c5c6b01&units=metric",
          type: "GET",
          success: function(response){
            var time = response.list;
            for(var i in time){
                if (i >= 10) {
                    break;
                }
              var date = new Date(time[i].dt_txt);
                data.labels.push(date.toLocaleString("en-US", {month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true}));
              data.datasets[0].data.push(time[i].main.temp);
                data.datasets[1].data.push(time[i].wind.speed);
                data.datasets[2].data.push((time[i].rain ? time[i].rain['3h'] : 0));
                data.datasets[3].data.push(time[i].main.humidity);
            }
            
            var chart = new Chart(ctx, {
              type: 'line',
              data: data,
              options: {
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero: true
                    }
                  }]
                },
                responsive: true,
                maintainAspectRatio: false
              }
            });
          }
        });
      });
    </script>