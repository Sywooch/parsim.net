<?php
  use common\models\User;
?>
<div class="row">
  <div class="col-xs-12 text-center">
    <div class="alert alert-success" role="alert">
      <h1>Ура!!!</h1>
      <p >Вы успешно зарегистрировали URL.</p>
      <p>Через несколько минут мы пришлем Вам на почту результат работы нашего парсера</p>
    </div>
  </div>
</div>
<?php if(isset($password)): ?>
<div class="row">
  <div class="col-xs-12 text-center">
    <div class="alert alert-info" role="alert">
      <h1>Теперь Вы можете управлять своими URL в личном кабинете</h1>
      <p >Для входа используюте логин и пароль, которые мы Вам выслали на E-mail</p>
    </div>
  </div>
</div>
<?php endif; ?>
<div class="row">
  <div class="col-xs-12 text-center">
      <button id="try-again" class="theme-btn btn-style-two">Создать еше один запрос</button>
      <a href="<?= User::getLoginUrl(); ?>" class="theme-btn btn-style-two">Войти в личный кабинет</a>
  </div>  
</div>
