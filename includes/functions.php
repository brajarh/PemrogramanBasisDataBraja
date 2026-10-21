<?php
require_once __DIR__ . '/../config/database.php';

function h($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function render_table(array $rows): void
{
    if (!$rows) {
        echo '<div class="alert alert-light border mb-0">Tidak ada baris data untuk ditampilkan.</div>';
        return;
    }

    echo '<div class="table-responsive"><table class="table table-striped table-hover align-middle mb-0"><thead><tr>';
    foreach (array_keys($rows[0]) as $column) {
        echo '<th scope="col">' . h($column) . '</th>';
    }
    echo '</tr></thead><tbody>';
    foreach ($rows as $row) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . ($value === null || $value === '' ? '<span class="text-secondary">—</span>' : h($value)) . '</td>';
        }
        echo '</tr>';
    }
    echo '</tbody></table></div>';
}
