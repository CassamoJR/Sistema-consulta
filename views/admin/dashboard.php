<?php use App\Core\Csrf; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h2>Painel Administrativo</h2>
    <p class="text-muted">Bem-vindo, <?= htmlspecialchars($user['nome'], ENT_QUOTES, 'UTF-8') ?>.</p>
  </div>
  <a class="btn btn-outline-primary" href="/admin/financeiro">Painel financeiro</a>
</div>

<h4>Membros pendentes</h4>
<div class="table-responsive">
<table class="table table-striped align-middle">
  <thead><tr><th>Nome</th><th>Província</th><th>Contacto</th><th>Ações</th></tr></thead>
  <tbody>
  <?php foreach ($pendingMembers as $member): ?>
    <tr>
      <td><?= htmlspecialchars($member['nome_completo'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($member['provincia'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($member['contacto'], ENT_QUOTES, 'UTF-8') ?></td>
      <td class="d-flex gap-2">
        <form method="POST" action="/admin/membro/aprovar">
          <input type="hidden" name="_csrf" value="<?= Csrf::token() ?>">
          <input type="hidden" name="id" value="<?= (int)$member['id'] ?>">
          <button class="btn btn-sm btn-success">Aprovar</button>
        </form>
        <form method="POST" action="/admin/membro/rejeitar">
          <input type="hidden" name="_csrf" value="<?= Csrf::token() ?>">
          <input type="hidden" name="id" value="<?= (int)$member['id'] ?>">
          <button class="btn btn-sm btn-danger">Rejeitar</button>
        </form>
        <a href="/admin/membro/editar?id=<?= (int)$member['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>
