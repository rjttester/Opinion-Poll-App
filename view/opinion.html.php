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

            <h1>Opinion Poll</h1>
            <br />

            <?php //print_r($data);?>
            <?php if(isset($_GET['e_message'])){
                echo '<div class="alert alert-danger">Sorry! Something went wrong while casting your vote in database. Please check your input.</div>';
             }?>
            
            <?php 
            foreach($records as $question => $poll):
            ?>
            <form method="post">
            <h3><?php echo $question;?></h3><br>
            <table class="table table-hover table-sm col-3">
                <thead>
                    <tr>
                        <th>Libraries</th>
                        <th>Vote</th>
                    </tr>
                </thead>
                <tbody>
               
            <?php
                foreach($poll as $answers):
                ?>
                    <tr>
                        <td><?php echo $answers['choice'];?></td>
                        <td>
                            <input type="hidden" name="cast_vote" value="1">
                            <input type="hidden" name="qid" value="<?php echo $answers['questionid'];?>">
                            <input type="radio" required=""  name="choice" value="<?php echo $answers['choice_id'];?>">
                        </td>
                    </tr>
                <?php
                endforeach;
            ?>
            
            <tr><td colspan="2" align="center"><br><input class="btn btn-primary" type="submit" value="Submit"></td></tr>
            </tbody>
            </table>
            </form>
            <?php
            endforeach;
            ?>
            
        </div>
    </div>

</body>
</html>