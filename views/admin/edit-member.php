<?php use App\Core\Csrf; ?>
<h3>Editar membro</h3>
<form method="POST" class="row g-3">
  <input type="hidden" name="_csrf" value="<?= Csrf::token() ?>">
  <input type="hidden" name="id" value="<?= (int)$member['id'] ?>">
  <div class="col-md-6"><label class="form-label">Nome completo</label><input class="form-control" name="nome_completo" value="<?= htmlspecialchars($member['nome_completo'], ENT_QUOTES, 'UTF-8') ?>" required></div>
  <div class="col-md-3"><label class="form-label">Género</label><input class="form-control" name="genero" value="<?= htmlspecialchars($member['genero'], ENT_QUOTES, 'UTF-8') ?>" required></div>
  <div class="col-md-3"><label class="form-label">Data de nascimento</label><input type="date" class="form-control" name="data_nascimento" value="<?= htmlspecialchars($member['data_nascimento'], ENT_QUOTES, 'UTF-8') ?>" required></div>
  <div class="col-md-4"><label class="form-label">Nível académico</label><input class="form-control" name="nivel_academico" value="<?= htmlspecialchars($member['nivel_academico'], ENT_QUOTES, 'UTF-8') ?>" required></div>
  <div class="col-md-4"><label class="form-label">Área de formação</label><input class="form-control" name="area_formacao" value="<?= htmlspecialchars($member['area_formacao'], ENT_QUOTES, 'UTF-8') ?>" required></div>
  <div class="col-md-4"><label class="form-label">Ano de ingresso</label><input type="number" class="form-control" name="ano_ingresso" value="<?= (int)$member['ano_ingresso'] ?>" required></div>
  <div class="col-md-3"><label class="form-label">Província</label><input class="form-control" name="provincia" value="<?= htmlspecialchars($member['provincia'], ENT_QUOTES, 'UTF-8') ?>" required></div>
  <div class="col-md-3"><label class="form-label">Distrito</label><input class="form-control" name="distrito" value="<?= htmlspecialchars($member['distrito'], ENT_QUOTES, 'UTF-8') ?>" required></div>
  <div class="col-md-2"><label class="form-label">ZIP</label><input class="form-control" name="zip" value="<?= htmlspecialchars($member['zip'], ENT_QUOTES, 'UTF-8') ?>" required></div>
  <div class="col-md-4"><label class="form-label">Escola</label><input class="form-control" name="escola" value="<?= htmlspecialchars($member['escola'], ENT_QUOTES, 'UTF-8') ?>" required></div>
  <div class="col-md-4"><label class="form-label">Contacto</label><input class="form-control" name="contacto" value="<?= htmlspecialchars($member['contacto'], ENT_QUOTES, 'UTF-8') ?>" required></div>
  <div class="col-12"><button class="btn btn-primary">Guardar alterações</button></div>
</form>
