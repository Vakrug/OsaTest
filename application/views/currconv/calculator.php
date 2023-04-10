<a href="/">Home</a>
<h1>Calculator</h1>
<?php echo validation_errors(); ?>

<?php echo form_open('currconv/calculator'); ?>

    <label for="from">From</label>
    <select name="from">
        <option value="">--select--</option>
        <?php foreach ($curr_list as $curr):  ?>
        <option value="<?= $curr ?>" <?= $curr == $this->input->post('from') ? 'selected' : '' ?> ><?= $curr ?></option>
        <?php endforeach ?>
    </select><br />

    <label for="to">To</label>
    <select name="to">
        <option value="">--select--</option>
        <?php foreach ($curr_list as $curr):  ?>
        <option value="<?= $curr ?>" <?= $curr == $this->input->post('to') ? 'selected' : '' ?> ><?= $curr ?></option>
        <?php endforeach ?>
    </select><br />
    
    <label for="amount">Amount</label>
    <input type="number" name="amount" value="<?= $this->input->post('amount') ?? 10 ?>" /><br />

    <input type="submit" name="submit" value="Calculate" />

<?php form_close(); ?>

    <?php if (isset($result)): ?>
    <p style="color: red;">
        <?= $result ?> 
    </p>
    <?php endif; ?>