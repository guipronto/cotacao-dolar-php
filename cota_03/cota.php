<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
            
    

<div class="container">
    
  <main>
        <header> <h1> Cotação do Dolar </h1> </header>

        <section>

          <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="get">
         
            <label for="ali"> Digite um valor em real </label>

            <input type="number" name="cota" id="cota"  required step="0.01">

            <input type="submit" value="Click para ver ">

          </form>
       
    <?php

        $inicio = date("m-d-Y" , strtotime("-7 days"));

        $fim = date("m-d-Y");

        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

        $dados = json_decode(file_get_contents($url),true);

        $cotacao = $dados["value"]["0"] ["cotacaoCompra"];

        $valorDigitado = str_replace(',', '.', $_GET['cota']);

        $valorDigitado = round((float)$valorDigitado, 2);

        $valorFinal = $valorDigitado / $cotacao ;

        echo"<p>cotação do dolar: " . number_format($cotacao, 2, '.', '')."</p>";

        echo "<p>Seu valor: $valorDigitado é equivalente a: ". number_format($valorFinal, 2, '.', ''). " dólares</p>";

        ?>

        </section>

    </main>

</div>


</body>



</html>