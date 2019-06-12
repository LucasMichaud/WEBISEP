<html>
<head>
    <meta charset="utf-8"/>
    <title>diagramme temperature</title>

</head>
<body>

<?php
    session_start();
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "espace_membre";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result=$conn->query('SELECT date,temperature FROM dbStatistique WHERE date<="2019-1-31"');
    while($row=$result->fetch()){
        $date1[]=$row['date'];
        $temperature1[]=$row['temperature'];
    }
    $result=$conn->query('SELECT date,temperature FROM dbStatistique  WHERE id_client="'.$_SESSION['id'].'" AND date>="2019-1-1" AND date<="2019-12-31"');
    $compteur=0;
    while($row=$result->fetch()){
        $compteur++;
        $date2[]=$row['date'];
        $temperature2[]=$row['temperature'];
    }
    if($compteur!=0){
    $date1=json_encode($date1);
    $date2=json_encode($date2);
    $temperature1=json_encode($temperature1,JSON_NUMERIC_CHECK);
    $temperature2=json_encode($temperature2,JSON_NUMERIC_CHECK);
    $conn = null;
}
?>

<script src="https://code.highcharts.com/highcharts.js"></script>

<div id="container" style=" margin: 0 auto"></div>

<script>
    Highcharts.chart('container', {
        chart: {
            type: 'area'
        },
        
        title: {
            text: 'témperature'
        },
        xAxis: {
            categories: <?php echo $date1;?>,
        },
    
        yAxis: {
            title: {
                text: 'degree'
            },
        
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
    
        tooltip: {
            split: true,
            valueSuffix: 'degree'
        },
    
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
            
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
    
        series: [{
            name: 'temperature',
            data: <?php echo $temperature1; ?>,
        }]
    });
</script>
</body>
</html>