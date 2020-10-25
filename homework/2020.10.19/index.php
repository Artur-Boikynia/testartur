<?php
error_reporting(E_ALL);

$messages = [];
$file = fopen(__DIR__ . '/storage', 'rb');
while ($line = fgets($file, 1024)) {
    $messages[] = json_decode(trim($line), true, 512, JSON_THROW_ON_ERROR);

}

fclose($file);

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="style3.css" rel="stylesheet" type="text/css"/>
    <title>Form</title>
        <script>
            function showMessage(text){
                 var div = document.getElementById(text),
                     style = div.style;
                style.display = 'block';
            }

            function hiddenMessage(text){
                var div = document.getElementById(text),
                    style = div.style;
                style.display = 'none';
            }
        </script>

</head>
<body>
    <div class="card text-white bg-dark mb-3" style="max-width: 120rem;">
        <div class="card-body">
            <h5 class="card-title">testFORM</h5>
        </div>
    </div>
    <div id="forms">
        <form action="/homework/2020.10.19/message.php" method="post" >
            <div class="form-group row" >
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" class="form-control" id="inputEmail3">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">First name</label>
                <div class="col-sm-10">
                    <input type="text" name="firstname" class="form-control" id="inputPassword3">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword4" class="col-sm-2 col-form-label">Second name</label>
                <div class="col-sm-10">
                    <input type="text" name="secondname" class="form-control" id="inputPassword4">
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Sex</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="man" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Man
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="woman">
                            <label class="form-check-label" for="gridRadios2">
                                Woman
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Comment</label>
                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="9"></textarea>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" name="submit" class="btn btn-primary" value="high">Submit Comment</button>
                </div>
            </div>
        </form>
    </div>
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">First Name</th>
            <th scope="col">Second Name</th>
            <th scope="col">Email</th>
            <th scope="col">Comment</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($messages as $key => $message) : ?>
        <tr>
            <td><?= $message['firstname'] ?></td>
            <td><?= $message['secondname'] ?></td>
            <td><?= $message['email'] ?></td>
            <td>
                <?= $message['message'] ?>
                <div class="classHidden" id="<?= $message['id'] ?>">
                    <form action="/homework/2020.10.19/edit.php" method="post">
                        <label for="exampleFormControlTextarea1">Edit your comments</label>
                        <textarea class="form-control" name="messageedit" id="exampleFormControlTextarea1" rows="3"> <?= $message['message'] ?> </textarea>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" name="close" class="btn btn-secondary" onclick="hiddenMessage(<?= $message['id'] ?>)">Close</button>
                          <button type="submit"  name="editSub" class="btn btn-secondary" value="<?= $message['id'] ?>">Submit</button>
                        </div>
                    </form>
                </div>
            </td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <form>
                        <button type="button" name="editBut" class="btn btn-secondary" id="editmessage" value="<?= $message['id'] ?>" onclick="showMessage(<?= $message['id'] ?>)" >Edit</button>
                    </form>
                </div>
            </td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <form action="/homework/2020.10.19/delete.php">
                        <button type="submit" name="buttons" class="btn btn-secondary" value="<?= $message['id'] ?>">Delete</button>
                    </form>
                </div>
            </td>
            <td><?= $message['date'] ?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>

</body>
</html>
