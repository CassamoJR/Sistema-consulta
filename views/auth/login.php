<?php use App\Core\Csrf; ?>
<div class="row justify-content-center">
  <div class="col-md-5">
    <h3>Login Administrativo</h3>
    <?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <form method="POST" class="card card-body">
      <input type="hidden" name="_csrf" value="<?= Csrf::token() ?>">
      <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" required></div>
      <div class="mb-3"><label class="form-label">Senha</label><input type="password" class="form-control" name="password" required></div>
      <button class="btn btn-primary">Entrar</button>
    </form>
  </div>
</div>
