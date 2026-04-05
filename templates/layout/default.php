<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP App';
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $cakeDescription ?>: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-color: #0d6efd;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar-brand span {
            color: var(--primary-color);
        }
        
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: box-shadow 0.3s;
        }
        
        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .table > thead {
            background-color: #f8f9fa;
        }
        
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .btn {
            font-weight: 500;
            padding: 0.5rem 1rem;
        }
        
        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.85rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        fieldset {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1.5rem;
            background: #fff;
        }
        
        legend {
            font-weight: 600;
            color: #495057;
            padding: 0 0.5rem;
        }
        
        .side-nav {
            background: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1rem;
        }
        
        .side-nav .heading {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #495057;
        }
        
        .side-nav a {
            display: block;
            padding: 0.5rem 0.75rem;
            color: #495057;
            text-decoration: none;
            border-radius: 0.375rem;
            transition: all 0.2s;
        }
        
        .side-nav a:hover {
            background: #e9ecef;
            color: var(--primary-color);
        }
        
        .actions a {
            margin-right: 0.25rem;
        }
        
        .pagination {
            margin-top: 1.5rem;
        }
        
        .alert {
            border: none;
            border-radius: 0.5rem;
        }
        
        main {
            flex: 1;
            padding: 2rem 0;
        }
        
        .theme-toggle-btn {
            background: transparent;
            border: 1px solid #dee2e6;
            color: #495057;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .theme-toggle-btn:hover {
            background: #f8f9fa;
        }
        
        [data-bs-theme="dark"] {
            --bs-body-bg: #212529;
            --bs-body-color: #dee2e6;
        }
        
        [data-bs-theme="dark"] fieldset {
            background: #2b3035;
            border-color: #495057;
        }
        
        [data-bs-theme="dark"] .side-nav {
            background: #2b3035;
        }
        
        [data-bs-theme="dark"] .side-nav a:hover {
            background: #495057;
        }
        
        [data-bs-theme="dark"] .table > thead {
            background-color: #2b3035;
        }
        
        [data-bs-theme="dark"] .table th {
            background-color: #2b3035;
        }
        
        [data-bs-theme="dark"] .navbar {
            background-color: #212529 !important;
            border-color: #495057 !important;
        }
        
        [data-bs-theme="dark"] .navbar-brand {
            color: #dee2e6;
        }
        
        [data-bs-theme="dark"] .navbar-brand span {
            color: #0d6efd;
        }
        
        [data-bs-theme="dark"] .theme-toggle-btn {
            border-color: #495057;
            color: #dee2e6;
        }
        
        [data-bs-theme="dark"] .theme-toggle-btn:hover {
            background: #495057;
        }
        
        [data-bs-theme="dark"] .btn-outline-primary {
            color: #0d6efd;
            border-color: #0d6efd;
        }
        
        [data-bs-theme="dark"] .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: #fff;
        }
        
        [data-bs-theme="dark"] .navbar {
            background-color: var(--bs-body-bg) !important;
            border-color: var(--bs-border-color) !important;
        }
        
        [data-bs-theme="dark"] .theme-toggle-btn {
            border-color: var(--bs-border-color);
        }
        
        .dropdown-item.active {
            background-color: #0d6efd;
            color: white;
        }
        
        [data-bs-theme="dark"] .dropdown-item.active {
            background-color: #0d6efd;
            color: white;
        }
    </style>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg border-bottom">
        <div class="container">
            <a class="navbar-brand" href="<?= $this->Url->build('/') ?>">
                <span>Cake</span>PHP
            </a>
            
            <div class="d-flex align-items-center gap-2">
                <?php 
                $identity = $this->request->getAttribute('identity');
                $currentLocale = $locale ?? 'es';
                ?>
                
                <?php if ($identity): ?>
                    <span class="navbar-text me-2">
                        <i class="bi bi-person-circle"></i> <?= h($identity->nombre) ?>
                    </span>
                <?php endif; ?>
                
                <button class="theme-toggle-btn" onclick="toggleTheme()" title="<?= __('Toggle theme') ?>">
                    <i class="bi bi-moon-stars" id="theme-icon"></i>
                </button>
                
                <?php if ($identity): ?>
                    <a href="<?= $this->Url->build('/users') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-people"></i> <?= __('Users') ?>
                    </a>
                    <a href="<?= $this->Url->build('/eventos') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-calendar-event"></i> <?= __('Events') ?>
                    </a>
                    <a href="<?= $this->Url->build('/logout') ?>" class="btn btn-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> <?= __('Logout') ?>
                    </a>
                <?php else: ?>
                    <a href="<?= $this->Url->build('/login') ?>" class="btn btn-primary btn-sm">
                        <i class="bi bi-box-arrow-in-right"></i> <?= __('Login') ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main>
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('theme-icon');
            
            if (html.getAttribute('data-bs-theme') === 'dark') {
                html.setAttribute('data-bs-theme', 'light');
                localStorage.setItem('theme', 'light');
                icon.className = 'bi bi-moon-stars';
            } else {
                html.setAttribute('data-bs-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                icon.className = 'bi bi-sun';
            }
        }

        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            document.getElementById('theme-icon').className = 'bi bi-sun';
        }
        
    </script>
</body>
</html>