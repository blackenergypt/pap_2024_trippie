<?php
session_start();

if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php");
    exit();
}

require '../config.php';
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - InnovaWall</title>
    <link rel="icon" href="../assets/images/lock.png" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <?php include 'includes/navbar.php'; ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include 'includes/sidebar.php'; ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <!-- Tabela de Pedidos -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Lista de Pedidos
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="ordersTable">
                                    <!-- Tabela será carregada dinamicamente via AJAX -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; InnovaWall 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Custom Scripts -->
    <script src="js/scripts.js"></script>

    <script>
    // Função para carregar dinamicamente a tabela de pedidos
    function loadOrdersTable() {
        $.ajax({
            url: 'fetch_orders.php',
            method: 'GET',
            data: { ajax: true }, // Enviar parâmetro para indicar AJAX request
            success: function(response) {
                $('#ordersTable').html(response.html);
                initializeDataTables();
            },
            error: function(xhr, status, error) {
                console.error('Erro ao carregar pedidos:', error);
            }
        });
    }

    // Função para inicializar DataTables
    function initializeDataTables() {
        new simpleDatatables.DataTable("#ordersTable", {
            searchable: true,
            fixedHeight: true,
            labels: {
                placeholder: "Procurar...",
                perPage: "{select} pedidos por página",
                noRows: "Nenhum pedido encontrado",
                info: "Mostrando {start} a {end} de {rows} pedidos",
            },
        });
    }

    // Carregar tabela de pedidos ao carregar a página
    $(document).ready(function() {
        loadOrdersTable();
    });

    // Manipulador de evento para alterar o status do pedido
    $(document).on('click', '.change-status', function(e) {
        e.preventDefault();
        var orderId = $(this).data('order-id');
        var newStatus = $(this).data('new-status');

        $.ajax({
            url: 'change_status.php',
            method: 'GET',
            data: { id: orderId, status: newStatus },
            success: function(response) {
                Swal.fire({
                    title: 'Sucesso!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    loadOrdersTable(); // Recarregar a tabela após a alteração
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao atualizar o status do pedido.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
    </script>
</body>
</html>
