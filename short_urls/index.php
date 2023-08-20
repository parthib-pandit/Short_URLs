<?php require 'config.php'; ?>


<?php

$select = $conn->query('SELECT * FROM urls');
$select->execute();

$rows = $select->fetchAll(PDO::FETCH_OBJ);

if(isset($_POST['submit'])) {
    if($_POST['url'] == '') {
        echo "the input is empty";
    }
    else {

        $url = $_POST['url'];

        $insert = $conn->prepare("INSERT INTO urls (url) VALUES (:url)");
        $insert->execute([
            ':url' => $url
        ]);
        }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    body {
        overflow: hidden;
    }

    .margin {
        margin-top: 200px
    }

    .btn {
        margin: 0 20px;
        border-radius: 10px;
    }
    .card{
        border: 0;
    }
    .jumbotron{
        text-align: center;
        
    }
    </style>
</head>

<body>


    <div class="jumbotron">
        <h1 class="display-4">Shorten Your URL</h1>
        <p class="lead">This is a simple Website that will shorten your long URLs. Feel free to use it. Enter your long url and click reload to get the shortened url.</p>
        <hr class="my-4">
    </div>
    <div class="conatiner">
        <div class="row  justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <form class="card" method="POST" action="index.php">
                    <div class="input-group">
                        <input type="text" name="url" class="form-control" placeholder="Your URL">
                        <div class="input-group-append">
                            <button type="submit" value="Reload Page" name="submit" id="btn" class="btn btn-success" onClick="reload()">Shorten</button>
                            <button type="submit" value="Reload Page" class="btn btn-success">Reload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="conatiner">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Long url</th>
                            <th scope="col">Short Url</th>
                            <th scope="col">Clicks</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach($rows as $row) :?>
                            <th scope="row"><?php echo $row->url; ?></th>
                            <td><a href="http://localhost/short_urls/u?id=<?php echo $row->id; ?>" target="_blank">
                                    http://localhost/short-urls/<?php echo $row->id; ?> </a></td>
                            <td><?php echo $row->clicks; ?></td>

                        </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="index.js"></script>
    <!-- Core theme JS-->
</body>

</html>