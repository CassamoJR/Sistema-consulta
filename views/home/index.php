<div class="p-5 mb-4 bg-light rounded-3">
    <h1 class="display-5 fw-bold">Associação Nacional dos Professores (ANAPRO)</h1>
    <p class="lead">Plataforma institucional para fortalecer a classe docente com processos digitais seguros.</p>
    <a class="btn btn-primary btn-lg" href="/membros/cadastro">Quero me cadastrar</a>
</div>

<div class="row g-4">
    <div class="col-md-4"><div class="card h-100"><div class="card-body"><h5>Missão</h5><p>Promover a valorização da carreira docente e boas práticas pedagógicas.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100"><div class="card-body"><h5>Visão</h5><p>Ser referência nacional em representação profissional e desenvolvimento de professores.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100"><div class="card-body"><h5>Objectivos</h5><p>Advocacia, formação contínua, integridade administrativa e sustentabilidade financeira.</p></div></div></div>
</div>

<section class="mt-4">
    <h4>Notícias e informações do Ministério da Educação</h4>
    <ul class="list-group">
        <?php foreach ($news as $item): ?>
            <li class="list-group-item"><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
    </ul>
</section>
