<?php include '../Template/header.php'; ?>
<!-- Main Sidebar Container -->
<?php include '../Template/sidebar.php'; ?>
<?php
$Company = $_SESSION['masuk']["AdminID"];
$user = query("SELECT msolimpiade.* FROM msolimpiade"); ?>


<!-- jQuery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<!-- CSS CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
<!-- datetimepicker jQuery CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
</script>

<!-- Basic inline styling -->
<style>
    body {
        text-align: center;
    }

    p {
        font-size: 25px;
        font-weight: bold;
    }
</style>
<h1 style="color:green">GeeksforGeeks</h1>
<p>jQuery - Set datetimepicker on textbox click</p>
<?php foreach ($user as $isi) : ?>
    <input type="text" class="datetimepicker" /><br>
    <div class="form-group">
        <label for="ExamDateEnd">Exam Date End</label>
        <div class="input-group date" data-target-input="nearest">
            <input type="Text" id="ExamDateEnd" name="ExamDateEnd" required class="form-control datetimepicker" autocomplete="off">
            <div class="input-group-append">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<script type="text/javascript">
    $(".datetimepicker").each(function() {
        $(this).datetimepicker();
    });
</script>
<?php include '../Template/footer.php'; ?>