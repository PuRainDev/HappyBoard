<br>
<main>
  <div class="bg-light p-5 rounded">
    <h1>HappyBoard</h1>
    <p class="lead">Простые текстовые объявления бесплатно и без смс.</p>
    <a class="btn btn-bd-light" href="/объявления" role="button">Просмотреть &raquo;</a>
  </div>
</main>
<br>
<br>
<h2 class="text-center">Последние обьявления</h2>
<p class="text-center">
Самые новые 20 объявлений
</p>
<br>
<br>
<div class="row" data-masonry="{&quot;percentPosition&quot;: true }" style="position: relative; height: 1250px;">
<?php
	foreach($data as $row) {
		echo '<div class="col-sm-6 col-lg-4 mb-4" style="position: absolute; left: 0%; top: 654px;">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">'.$row['2'].'</h5>
          <p class="card-text">'.$row['3'].'</p>
          <p class="card-text"><small class="text-muted">'.$row['4'].'</small></p>
        </div>
      </div>
    </div>';
	}
?>
</div>