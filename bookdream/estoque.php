<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookdream";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve book data from the database
$sql = "SELECT id, titulo, autor, editora, genero, qtd FROM livros";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque de Livros</title>
    <style>
    body {
            font-family: Arial, sans-serif;
        }

        .container {
          max-width: 90%;
          margin: 0 auto;
          margin-top: 30px;
          padding: 20px;
          background-color: #f2f2f2;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        #menu1, #menu2 {
          display: flex;
        }
        
        #menu1 a, #menu2 a {
          font-family: Arial, sans-serif;
          text-decoration: none;
          color: white;
          padding: 10px;
          margin-right: 10px;
          background-color: #BEA4F1;
          border-radius: 5px;
          font-size: 20px;
        }
        
        #menu1 a:hover {
          background-color: #AFCCF4;
        }

         #menu2 a:hover {
          background-color: #AFCCF4;
        }

        #menu2 {
          margin-left: 690px;
        }
        #header {
        margin-left: 0;
        background-color: #AFCCF4;
        padding: 10px;
        display: flex;
        align-items: center;
        }
        .logo {
          height: 80px;
          width: 150px;
        }
        h1 {
            text-align: center;
        }

        h2{
           font-size: 15px;
           border-radius: 10px;
           color:#BEA4F1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #ddd;
            font-weight: bold;
            
        }

        #qtd{
            text-align: center;
        }
        td a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        td a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<div id="header">
        <img class="logo" src="imagens/logo-book-dream2.png">
        <div id="menu1">
            <a href="cadlivro.php">Cadastro</a>
            <a href="#">Estoque</a>
            <a href="carrinho.php">Carrinho</a>
        </div>
        <div id="menu2">
            <a href="">Sair</a>
            <a href="login.php">login</a>
        </div>
    </div>
<body>

<div class="container">
<h1>Estoque de Livros</h1>
<h2>Consulta de Livros</h2>
    <form method="get" action="resultados.php">
        <input type="text" name="query" placeholder="Digite sua pesquisa" required>
        <input type="submit" value="Pesquisar">
    </form>

<table>
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Editora</th>
        <th>Gênero</th>
        <th>Quantidade</th>
        <th>Ações</th>
    </tr>



    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["titulo"] . "</td>";
            echo "<td>" . $row["autor"] . "</td>";
            echo "<td>" . $row["editora"] . "</td>";
            echo "<td>" . $row["genero"] . "</td>";
            echo "<td>" . $row["qtd"] . "</td>";
            echo "<td>";
            echo "<a href='editar_item.php?id=" . $row["id"] . "'>editar</a> ";
            echo "<a href='remover.php?id=" . $row["id"] . "'>excluir</a>";

            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Nenhum livro cadastrado.</td></tr>";
    }
/* video editar dados no formulario: https://www.youtube.com/watch?v=sNqH8Nql1iA */ 
    ?>

</table>
</div>
</body>
</html>

<?php
$conn->close();
?>