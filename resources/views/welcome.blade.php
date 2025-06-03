<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Ordem de Serviço</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .card-os {
            cursor: pointer;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border-radius: 0.75rem;
        }
        .card-os:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .modal-content {
            border-radius: 0.75rem;
        }
        .btn-primary, .btn-secondary, .btn-info, .btn-success, .btn-danger {
            border-radius: 0.5rem;
        }
        .form-control {
            border-radius: 0.5rem;
        }
        .card-icon {
            font-size: 3rem;
            color: #007bff;
            margin-bottom: 1rem;
        }
        .card-body-os-trigger { /* Renamed to avoid conflict */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 200px;
        }
        .input-group .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .input-group .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        #osItemsList .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #osItemsList .item-details {
            flex-grow: 1;
        }
        .total-amount-display {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .item-actions button {
            margin-left: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card card-os text-center shadow-sm" data-toggle="modal" data-target="#osModal">
                    <div class="card-body card-body-os-trigger">
                        <i class="fas fa-tools card-icon"></i>
                        <h5 class="card-title h4">Iniciar OS</h5>
                        <p class="card-text text-muted">Clique para criar uma nova Ordem de Serviço.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main OS Modal -->
    <div class="modal fade" id="osModal" tabindex="-1" aria-labelledby="osModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="osModalLabel">Nova Ordem de Serviço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="osForm">
                        <!-- Client Information Section -->
                        <fieldset class="border p-3 mb-4 rounded">
                            <legend class="w-auto px-2 h6">Informações do Cliente</legend>
                            <div class="form-group">
                                <label for="clientSearchDocument">Documento do Cliente (CPF/CNPJ)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="clientSearchDocument" placeholder="Digite o documento para buscar">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="button" id="verifyClientBtn">
                                            <i class="fas fa-search"></i> Verificar Cliente
                                        </button>
                                    </div>
                                </div>
                                <div id="clientVerificationResult" class="mt-2"></div>
                            </div>
                            <input type="hidden" id="clientId" name="clientId">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="clientName">Nome do Cliente <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="clientName" name="clientName" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="clientContact">Contato (Telefone/Email)</label>
                                        <input type="text" class="form-control" id="clientContact" name="clientContact">
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="clientAddress">Endereço</label>
                                <input type="text" class="form-control" id="clientAddress" name="clientAddress" placeholder="Rua, Número, Bairro, Cidade...">
                            </div>
                        </fieldset>

                        <!-- Items Section -->
                        <fieldset class="border p-3 mb-4 rounded">
                            <legend class="w-auto px-2 h6">Itens da Ordem de Serviço</legend>
                            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addItemModal">
                                <i class="fas fa-plus-circle"></i> Adicionar Serviço/Venda
                            </button>
                            <div id="osItemsList" class="list-group mb-3">
                                <!-- Items will be dynamically added here -->
                                <p class="text-muted" id="noItemsMessage">Nenhum item adicionado ainda.</p>
                            </div>
                            <div class="text-right">
                                <h5>Total: <span id="osTotalAmount" class="total-amount-display">R$ 0,00</span></h5>
                            </div>
                        </fieldset>

                        <div class="form-group">
                            <label for="osDescription">Observações Gerais da OS</label>
                            <textarea class="form-control" id="osDescription" name="osDescription" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="submitOsBtn"><i class="fas fa-save"></i> Criar OS</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Adicionar Item à OS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addItemForm">
                        <input type="hidden" id="editItemIndex" value="-1"> <!-- For editing items -->
                        <div class="form-group">
                            <label for="itemType">Tipo <span class="text-danger">*</span></label>
                            <select class="form-control" id="itemType" required>
                                <option value="">-- Selecione --</option>
                                <option value="manutencao">Serviço de Manutenção</option>
                                <option value="venda">Venda de Produto</option>
                            </select>
                        </div>

                        <div class="form-group" id="specificItemContainer" style="display: none;">
                            <label for="specificItem">Item Específico <span class="text-danger">*</span></label>
                            <select class="form-control" id="specificItem" required>
                                <option value="">-- Selecione --</option>
                            </select>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" id="itemQuantityContainer" style="display: none;">
                                    <label for="itemQuantity">Quantidade <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="itemQuantity" value="1" min="1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="itemPrice">Preço Unitário/Serviço (R$) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="itemPrice" step="0.01" min="0" required>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="itemDescription">Descrição do Item (Opcional)</label>
                            <textarea class="form-control" id="itemDescription" rows="2" placeholder="Ex: Cor, modelo, detalhes do serviço..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="saveItemBtn"><i class="fas fa-check"></i> Adicionar Item</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // --- Mock Data ---
            const mockClients = [
                { id: "1", name: "João Silva", document: "11122233344", contact: "(11) 99999-8888", address: "Rua das Palmeiras, 123, São Paulo" },
                { id: "2", name: "Maria Oliveira", document: "55566677788", contact: "maria.o@email.com", address: "Av. Central, 456, Rio de Janeiro" },
                { id: "3", name: "Empresa XYZ Ltda", document: "12345678000199", contact: "(21) 2233-4455", address: "Praça da Sé, 789, Salvador" }
            ];

            const serviceAndProductOptions = {
                manutencao: [
                    { value: "reparo_tela_celular", text: "Reparo de Tela de Celular", price: 150.00 },
                    { value: "troca_bateria_notebook", text: "Troca de Bateria de Notebook", price: 250.00 },
                    { value: "limpeza_interna_pc", text: "Limpeza Interna de PC", price: 100.00 },
                    { value: "formatacao_sistema", text: "Formatação e Reinstalação de Sistema", price: 120.00 },
                    { value: "diagnostico_avancado", text: "Diagnóstico Avançado", price: 80.00 }
                ],
                venda: [
                    { value: "mouse_gamer_rgb", text: "Mouse Gamer RGB", price: 180.00 },
                    { value: "teclado_mecanico", text: "Teclado Mecânico", price: 350.00 },
                    { value: "ssd_500gb", text: "SSD 500GB", price: 400.00 },
                    { value: "monitor_24_pol", text: "Monitor 24 Polegadas Full HD", price: 900.00 },
                    { value: "cabo_hdmi_2m", text: "Cabo HDMI 2m", price: 30.00 }
                ]
            };

            let currentOsItems = [];
            let editingItemIndex = -1; // To track if we are editing an existing item

            // --- Client Verification Logic ---
            $('#verifyClientBtn').on('click', function() {
                const docNumber = $('#clientSearchDocument').val().trim();
                const $resultDiv = $('#clientVerificationResult');
                
                // Clear previous results and fields
                $resultDiv.html('');
                $('#clientId, #clientName, #clientContact, #clientAddress').val('');
                $('#clientName, #clientContact, #clientAddress').prop('readonly', false);


                if (!docNumber) {
                    $resultDiv.html('<div class="alert alert-warning alert-dismissible fade show" role="alert">Por favor, digite um documento.<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    return;
                }

                $resultDiv.html('<div class="text-info"><i class="fas fa-spinner fa-spin"></i> Verificando...</div>');
                
                setTimeout(function() { // Simulate API call
                    const foundClient = mockClients.find(client => client.document === docNumber);
                    if (foundClient) {
                        $('#clientId').val(foundClient.id);
                        $('#clientName').val(foundClient.name).prop('readonly', true);
                        $('#clientContact').val(foundClient.contact).prop('readonly', true);
                        $('#clientAddress').val(foundClient.address).prop('readonly', true);
                        $resultDiv.html(`<div class="alert alert-success alert-dismissible fade show" role="alert">Cliente encontrado: <strong>${foundClient.name}</strong>.<button type="button" class="close" data-dismiss="alert">&times;</button></div>`);
                    } else {
                        $resultDiv.html('<div class="alert alert-info alert-dismissible fade show" role="alert">Cliente não encontrado. Preencha os dados manualmente ou cadastre um novo cliente.<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                         $('#clientName').focus(); // Focus on name if not found
                    }
                }, 1000);
            });

            // --- Add Item Modal Logic ---
            $('#itemType').on('change', function() {
                const type = $(this).val();
                const $specificContainer = $('#specificItemContainer');
                const $specificSelect = $('#specificItem');
                const $quantityContainer = $('#itemQuantityContainer');

                $specificSelect.empty().append('<option value="">-- Selecione --</option>');
                $('#itemPrice').val(''); // Clear price on type change

                if (type && serviceAndProductOptions[type]) {
                    serviceAndProductOptions[type].forEach(opt => {
                        $specificSelect.append(`<option value="${opt.value}" data-price="${opt.price || ''}">${opt.text}</option>`);
                    });
                    $specificContainer.slideDown();
                    $quantityContainer.toggle(type === 'venda');
                    if (type === 'manutencao') $('#itemQuantity').val(1); // Default quantity for service is 1
                } else {
                    $specificContainer.slideUp();
                    $quantityContainer.slideUp();
                }
            });
            
            $('#specificItem').on('change', function(){
                const selectedOption = $(this).find('option:selected');
                const price = selectedOption.data('price');
                if(price) {
                    $('#itemPrice').val(parseFloat(price).toFixed(2));
                } else {
                     $('#itemPrice').val(''); // Clear if no price is set
                }
            });


            $('#saveItemBtn').on('click', function() {
                const type = $('#itemType').val();
                const specificItemVal = $('#specificItem').val();
                const specificItemText = $('#specificItem option:selected').text();
                const quantity = parseInt($('#itemQuantity').val()) || 1;
                const price = parseFloat($('#itemPrice').val());
                const itemDescription = $('#itemDescription').val().trim();

                // Basic Validation
                let isValid = true;
                if (!type) { $('#itemType').addClass('is-invalid'); isValid = false; } else { $('#itemType').removeClass('is-invalid'); }
                if (!specificItemVal) { $('#specificItem').addClass('is-invalid'); isValid = false; } else { $('#specificItem').removeClass('is-invalid'); }
                if (isNaN(price) || price < 0) { $('#itemPrice').addClass('is-invalid'); isValid = false; } else { $('#itemPrice').removeClass('is-invalid'); }
                if (type === 'venda' && (isNaN(quantity) || quantity < 1)) { $('#itemQuantity').addClass('is-invalid'); isValid = false; } else { $('#itemQuantity').removeClass('is-invalid'); }

                if (!isValid) return;

                const item = {
                    type: type,
                    id: specificItemVal,
                    name: specificItemText,
                    quantity: type === 'venda' ? quantity : 1,
                    price: price,
                    description: itemDescription,
                    subtotal: (type === 'venda' ? quantity : 1) * price
                };
                
                const editIndex = parseInt($('#editItemIndex').val());
                if (editIndex > -1) { // Editing existing item
                    currentOsItems[editIndex] = item;
                } else { // Adding new item
                    currentOsItems.push(item);
                }


                renderOsItems();
                $('#addItemModal').modal('hide');
            });

            $('#addItemModal').on('hidden.bs.modal', function() {
                $('#addItemForm')[0].reset();
                $('#itemType').trigger('change'); // Reset dynamic fields
                $('#addItemForm .is-invalid').removeClass('is-invalid');
                $('#editItemIndex').val('-1'); // Reset edit index
                $('#saveItemBtn').html('<i class="fas fa-check"></i> Adicionar Item').removeClass('btn-warning').addClass('btn-primary');
                $('#addItemModalLabel').text('Adicionar Item à OS');
            });
            
            // --- OS Items Rendering and Management ---
            function renderOsItems() {
                const $list = $('#osItemsList');
                $list.empty();
                let totalAmount = 0;

                if (currentOsItems.length === 0) {
                    $list.html('<p class="text-muted" id="noItemsMessage">Nenhum item adicionado ainda.</p>');
                } else {
                    currentOsItems.forEach((item, index) => {
                        totalAmount += item.subtotal;
                        const itemHtml = `
                            <div class="list-group-item">
                                <div class="item-details">
                                    <strong>${item.name}</strong> (${item.type === 'venda' ? 'Venda' : 'Serviço'})
                                    <small class="d-block text-muted">
                                        ${item.type === 'venda' ? `Qtd: ${item.quantity} x ` : ''}
                                        R$ ${item.price.toFixed(2)}
                                        ${item.description ? ` | ${item.description}` : ''}
                                    </small>
                                </div>
                                <div class="item-subtotal mr-3">
                                    <strong>R$ ${item.subtotal.toFixed(2)}</strong>
                                </div>
                                <div class="item-actions">
                                    <button type="button" class="btn btn-sm btn-outline-primary edit-item-btn" data-index="${index}" title="Editar Item">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-item-btn" data-index="${index}" title="Remover Item">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                        $list.append(itemHtml);
                    });
                }
                $('#osTotalAmount').text(`R$ ${totalAmount.toFixed(2)}`);
            }

            $('#osItemsList').on('click', '.remove-item-btn', function() {
                const index = $(this).data('index');
                currentOsItems.splice(index, 1);
                renderOsItems();
            });
            
            $('#osItemsList').on('click', '.edit-item-btn', function() {
                const index = $(this).data('index');
                const itemToEdit = currentOsItems[index];
                
                $('#editItemIndex').val(index); // Set index for editing
                $('#itemType').val(itemToEdit.type).trigger('change'); // Trigger change to load specific items
                
                // Need a slight delay for specific items to load
                setTimeout(() => {
                    $('#specificItem').val(itemToEdit.id);
                }, 100);

                $('#itemQuantity').val(itemToEdit.quantity);
                $('#itemPrice').val(itemToEdit.price.toFixed(2));
                $('#itemDescription').val(itemToEdit.description);
                
                $('#addItemModalLabel').text('Editar Item da OS');
                $('#saveItemBtn').html('<i class="fas fa-save"></i> Salvar Alterações').removeClass('btn-primary').addClass('btn-warning');
                $('#addItemModal').modal('show');
            });


            // --- Submit OS ---
            $('#submitOsBtn').on('click', function() {
                let isValid = true;
                // Validate client name
                if (!$('#clientName').val().trim()) {
                    $('#clientName').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#clientName').removeClass('is-invalid');
                }

                if (currentOsItems.length === 0) {
                    // Optionally show an error message that at least one item is required
                    alert("Por favor, adicione pelo menos um serviço ou produto à OS.");
                    isValid = false;
                }

                if (!isValid) {
                    // Scroll to the first invalid field if possible, or show a general error
                    const firstInvalid = $('.is-invalid').first();
                    if(firstInvalid.length) {
                        $('#osModal .modal-body').animate({
                            scrollTop: firstInvalid.offset().top - $('#osModal .modal-body').offset().top + $('#osModal .modal-body').scrollTop() - 20
                        }, 500);
                         firstInvalid.focus();
                    }
                    return;
                }

                const osData = {
                    clientId: $('#clientId').val(),
                    clientName: $('#clientName').val(),
                    clientContact: $('#clientContact').val(),
                    clientAddress: $('#clientAddress').val(),
                    clientDocument: $('#clientSearchDocument').val(), // The searched document
                    items: currentOsItems,
                    totalAmount: parseFloat(currentOsItems.reduce((sum, item) => sum + item.subtotal, 0).toFixed(2)),
                    description: $('#osDescription').val()
                };

                console.log("OS Data to Submit:", osData);
                // alert("Ordem de Serviço criada com sucesso! (Verifique o console para os dados)");
                $('#osModalLabel').after('<div class="alert alert-success alert-dismissible fade show m-3" role="alert">Ordem de Serviço criada com sucesso! (Dados no console).<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                setTimeout(function() { $('.alert-success').alert('close'); }, 4000);


                $('#osModal').modal('hide');
            });

            $('#osModal').on('hidden.bs.modal', function() {
                $('#osForm')[0].reset();
                $('#clientVerificationResult').html('');
                $('#clientName, #clientContact, #clientAddress').prop('readonly', false);
                currentOsItems = [];
                renderOsItems();
                $('.is-invalid').removeClass('is-invalid');
                $('.alert-success').alert('close');
            });
            
            // Make main modal larger by default
            // $('#osModal .modal-dialog').addClass('modal-xl');

        });
    </script>
</body>
</html>
