<table>
<?php foreach ($users as $user): ?>
    <?php echo render('test/user', array('user' => $user))?>
<?php endforeach ?>
</table>

<?php echo render('test/new')?>
