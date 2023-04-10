<a href="/">Home</a>
<h1>Currency list</h1>
<ul>
<?php foreach ($list as $currencyCode): ?>
    <li>
        <?= $currencyCode ?>
    </li>
<?php endforeach; ?>
</ul>