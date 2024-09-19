<?php require_once ROOT . '/private/views/header.php'; ?>

    <div class='admin_panel'>

        <aside class='admin_nav'>

            <nav class='admin_scroll'>



                <?php if (!empty($this->adminPanel)):
                    foreach ($this->adminPanel as $key => $value): ?>
                        <?php if (is_array($value)): ?>
                            <div class='admin_nav_group'>
                                <div class='admin_nav_title'>
                                    <span><?= $key ?></span>
                                </div>
                                <div class='admin_nav_pages'>
                                    <?php foreach ($value as $file => $name): ?>
                                        <a href='/admin/<?= $file ?>'
                                           class='<?= (URI == 'admin/' . $file) ? 'active' : '' ?>'>
                                            <?= $name ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <a href='/admin/<?= $key ?>'
                               class='<?= (URI == 'admin/' . $key) ? 'active' : '' ?>'>
                                <?= $value ?>
                            </a>
                        <?php endif;
                    endforeach;
                endif; ?>
            </nav>

            <div class='admin_copyright'>
                <span>&copy; 2011 - <?= date('Y') ?> VisualTeam Ltd. Co.</span>
            </div>

        </aside>

        <div class='admin_content admin_scroll'>
            <?= ($this->module) ?: 'Данный модуль не существует' ?>
        </div>

    </div>

<?php require_once ROOT . '/private/views/footer.php';