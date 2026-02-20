<h2>Painel Financeiro</h2>
<div class="row g-3 mb-4">
  <div class="col-md-4"><div class="card"><div class="card-body"><h6>Total mês</h6><p class="fs-4"><?= number_format($monthlyTotal, 2, ',', '.') ?> MZN</p></div></div></div>
  <div class="col-md-4"><div class="card"><div class="card-body"><h6>Total ano</h6><p class="fs-4"><?= number_format($yearlyTotal, 2, ',', '.') ?> MZN</p></div></div></div>
  <div class="col-md-4"><div class="card"><div class="card-body"><h6>Membros em atraso</h6><p class="fs-4"><?= (int)$overdue ?></p></div></div></div>
</div>

<div class="card mb-3">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Relatório por província</span>
    <div class="d-flex gap-2">
      <a href="/admin/financeiro/export/pdf" class="btn btn-sm btn-outline-danger">Exportar PDF</a>
      <a href="/admin/financeiro/export/excel" class="btn btn-sm btn-outline-success">Exportar Excel</a>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table mb-0"><thead><tr><th>Província</th><th>Total arrecadado</th></tr></thead><tbody>
      <?php foreach ($provinceReport as $item): ?>
      <tr><td><?= htmlspecialchars($item['provincia'] ?: 'Sem província', ENT_QUOTES, 'UTF-8') ?></td><td><?= number_format((float)$item['total'], 2, ',', '.') ?> MZN</td></tr>
      <?php endforeach; ?>
    </tbody></table>
  </div>
</div>
