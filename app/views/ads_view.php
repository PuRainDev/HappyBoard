<br>
<main>
  <div class="bg-light p-5 rounded">
    <h1>HappyBoard</h1>
    <p class="lead">Список всех объявлений</p>
  </div>
</main>
<br>
<br>
<h2 class="text-center"><?php echo 'Объявления с '.$data['min'].' по '.$data['max']; ?></h2>
<br>
<br>
<div class="row" data-masonry="{&quot;percentPosition&quot;: true }" style="position: relative; height: 1250px;">
<?php
	foreach($data['0'] as $row) {
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
<div class="text-center d-flex justify-content-center">
	<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
		<div class="btn-group mr-2" role="group" aria-label="First group">
		<?php
			for ($i=1; $i <= $data['count']; $i++) {
				echo '<a hrf="/объявления/'.$i.'"><button type="button" class="btn btn-light">'.$i.'</button></a>';
			}
		?>
		</div>
	</div>
</div>
</div>
