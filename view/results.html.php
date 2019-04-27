<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Opinion Poll</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

    <div class="container">
        <div clas="row" align="center">

            <h1>Opinion Poll Result</h1>
            <br />
            <div class="alert alert-success">Thank you. Please see the results below.</div>
           
            <?php
            foreach($records as $question => $poll):
            ?>
            <h3><?php echo $question;?></h3>
            <table class="table table-hover table-sm col-3">
                <thead>
                    <tr>
                        <th>Libraries</th>
                        <th>Votes</th>
                    </tr>
                </thead>
                <tbody>
               
            <?php
                foreach($poll as $answers):
                ?>
                    <tr>
                        <td><?php echo $answers['choice'];?></td>
                        <td><?php echo $db_obj->getCount($answers['questionid'],$answers['choice_id']);?></td>
                    </tr>
                <?php
                endforeach;
            endforeach;
            ?>
            </tbody>
            </table>

            
        </div>
    </div>

</body>
</html>