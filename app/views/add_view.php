<br>
<main>
  <div class="bg-light p-5 rounded">
    <h1>Добавление объявления</h1>
    <p class="lead">Первая доска объявлений без необходимости в регистрации. Публикация объявления в один шаг.</p>
  </div>
</main>
<br>
<br>
<?php echo $data['msg']; ?>
<form action="" method="post" if="adform">
  <h2>Ваше объявление</h2>
  <br>
  <div class="form-label-group">
    <input name="inputHeader" type="text" id="inputHeader" maxlength="128" class="form-control" placeholder="Заголовок" required="" autofocus="">
    <label for="inputHeader">Заголовок</label>
  </div>

  <div class="form-label-group">
    <textarea name="inputContent" type="text" id="inputContent" maxlength="1024" class="form-control" placeholder="Текст объявления" required=""></textarea>
	<label for="inputContent">Текст объявления</label>
  </div>

  <div class="form-label-group">
    <input name="inputContacts" type="text" id="inputContacts" maxlength="128" class="form-control" placeholder="Как с вами связаться" required="">
    <label for="inputContacts">Как с вами связаться</label>
  </div>

  <div class="g-recaptcha" data-sitekey="<?php echo $GLOBALS['config']['recaptcha_public_key']; ?>"></div>
  <br>
  <button class="btn btn-lg btn-bd-light btn-block" type="submit" value="Submit">Опубликовать</button>
</form>
<br>
<br>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
