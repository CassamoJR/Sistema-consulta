<?php use App\Core\Csrf; ?>
<h2>Cadastro de Membro</h2>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li><?php endforeach; ?></ul></div>
<?php endif; ?>
<form id="memberForm" method="POST" class="row g-3">
    <input type="hidden" name="_csrf" value="<?= Csrf::token() ?>">
    <?php $old = $old ?? []; ?>
    <div class="col-md-6"><label class="form-label">Nome completo</label><input class="form-control" name="nome_completo" required value="<?= htmlspecialchars($old['nome_completo'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
    <div class="col-md-3"><label class="form-label">Género</label><select class="form-select" name="genero" required><option value="">Selecione</option><option>Masculino</option><option>Feminino</option><option>Outro</option></select></div>
    <div class="col-md-3"><label class="form-label">Data de nascimento</label><input type="date" class="form-control" name="data_nascimento" required></div>
    <div class="col-md-4"><label class="form-label">Nível académico</label><input class="form-control" name="nivel_academico" required></div>
    <div class="col-md-4"><label class="form-label">Área de formação</label><input class="form-control" name="area_formacao" required></div>
    <div class="col-md-4"><label class="form-label">Ano de ingresso</label><input type="number" class="form-control" name="ano_ingresso" min="1980" max="<?= date('Y') ?>" required></div>
    <div class="col-md-3"><label class="form-label">Província</label><input class="form-control" name="provincia" required></div>
    <div class="col-md-3"><label class="form-label">Distrito</label><input class="form-control" name="distrito" required></div>
    <div class="col-md-2"><label class="form-label">ZIP</label><input class="form-control" name="zip" required></div>
    <div class="col-md-4"><label class="form-label">Escola</label><input class="form-control" name="escola" required></div>
    <div class="col-md-4"><label class="form-label">Contacto</label><input class="form-control" name="contacto" required></div>
    <div class="col-12"><button class="btn btn-primary">Submeter cadastro</button></div>
</form>

<script>
document.getElementById('memberForm').addEventListener('submit', function (e) {
  const year = Number(document.querySelector('[name="ano_ingresso"]').value);
  const currentYear = new Date().getFullYear();
  const birth = new Date(document.querySelector('[name="data_nascimento"]').value);
  const age = currentYear - birth.getFullYear();
  const contact = document.querySelector('[name="contacto"]').value;

  if (year > currentYear) {
    e.preventDefault();
    alert('Ano de ingresso não pode ser superior ao ano actual.');
    return;
  }

  if (age < 18 || age > 80) {
    e.preventDefault();
    alert('Idade fora da faixa plausível para docente.');
    return;
  }

  if (!/^\+?[0-9\-\s]{9,20}$/.test(contact)) {
    e.preventDefault();
    alert('Contacto inválido.');
  }
});
</script>
