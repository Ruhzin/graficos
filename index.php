<?php
$name = "Rubens";
$resp = file_get_contents("https://servicodados.ibge.gov.br/api/v2/censos/nomes/$name");
$resp = json_decode($resp, true);

//Verificando se os dados da ap estavam vindo, var_dump($resp);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Frequência Nome</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/helpers.esm.min.js" integrity="sha512-4OeC7P+qUXB7Kpyeu1r5Y209JLXfCkwGKDpk8vnXzeNGMnpTr6hzOz2lMm7h0oxRBVu2ZCPRkCBPMmIlWsbaHg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.esm.min.js" integrity="sha512-viBARNC43u175Exx9Fhcm985ysTEIrKagpWCl62NkxyVm9/Y7BylO+eVH8Kdsf7mKmyuF07Zypv2QQRYMmdNmw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <!-- Gráfico -->
    <div style="width: 500px;">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
<script>
    // dados vindo da api

var labels = [
    <?php 
        foreach($resp[0]['res'] as $v){
            echo "'".$v['periodo']."',";
        }
    ?>
];

var data = [
    <?php 
        foreach($resp[0]['res'] as $v){
            echo "'".$v['frequencia']."',";
        }
    ?>
];
    // verificando se os dados estão corretos

console.log(labels);
console.log(data);

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# Frequencia da nome <?php echo $resp[0]['nome']; ?>',
            data: data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
</body>
</html>