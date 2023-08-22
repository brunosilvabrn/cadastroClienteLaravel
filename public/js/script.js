const estadoSelectForm = document.getElementById('estadoSelect');
const municipioSelectForm = document.getElementById('municipioSelect');

async function listEstados(estadoSelect = estadoSelectForm) {
    const response = await fetch("https://servicodados.ibge.gov.br/api/v1/localidades/estados");
    const estados = await response.json();

    estados.sort((a, b) => a.nome.localeCompare(b.nome));

    estados.forEach(estado => {

        addOption(estadoSelect, estado.sigla, estado.nome);

    });
}

async function listMunicipio(uf, municipioSelect = municipioSelectForm) {
    const response = await fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`);
    const municipios = await response.json();

    clearOptions(municipioSelect);

    municipios.sort((a, b) => a.nome.localeCompare(b.nome));

    addOption(municipioSelect, 'null', 'Selecionar municipio');

    municipios.forEach(municipio => {

        addOption(municipioSelect, municipio.nome, municipio.nome);

    });
}

listEstados();

estadoSelectForm.addEventListener('change', function () {
    const estadoUf = this.value;
    document.getElementById('UF').value = estadoUf;
    listMunicipio(estadoUf);
});


function addOption(elementDom, value, text) {
    const option = document.createElement('option');
    option.value = value;
    option.textContent = text;
    elementDom.appendChild(option);

}

function clearOptions(selectElement) {
    while (selectElement.options.length > 0) {
        selectElement.remove(0);
    }
}

function closeModalEdit() {
    document.getElementById('modalEdit').style.display = 'none';
}

function openModalEdit(id) {
    document.getElementById('idClient').value = id;
    document.getElementById('modalEdit').style.display = 'block';
}

function mascaraCpf(input) {
    input.addEventListener('input', (event) => {
        let inputValue = event.target.value.replace(/\D/g, '');
        if (inputValue.length > 11) {
            inputValue = inputValue.slice(0, 11);
        }

        if (inputValue.length > 9) {
            inputValue = inputValue.replace(/^(\d{3})(\d{3})(\d{3})/, '$1.$2.$3.');
        } else if (inputValue.length > 6) {
            inputValue = inputValue.replace(/^(\d{3})(\d{3})/, '$1.$2.');
        } else if (inputValue.length > 3) {
            inputValue = inputValue.replace(/^(\d{3})/, '$1.');
        }

        event.target.value = inputValue;
    });
}

const cpfInputs = document.querySelectorAll('.mascaraCpf');
cpfInputs.forEach(input => {
    mascaraCpf(input);
});

document.addEventListener('DOMContentLoaded', function () {

    const formClient = document.getElementById('formClient');

    if (formClient) {

        formClient.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            const formDataObject = Object.fromEntries(formData.entries());

            console.log(formDataObject);

            fetch('http://localhost:8000/api/client', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formDataObject)
            })
                .then(response => response.json())
                .then(data => {
                    alert('CLIENTE CADASTRADO COM SUCESSO');
                    window.location.href = "http://localhost:8000/";
                })
                .catch(error => {
                    console.error('Erro ao enviar dados:', error);
                });
        });
    }
});

document.getElementById('formSearch').addEventListener('submit', function (event) {
    event.preventDefault();

    const searchForm = document.getElementById('formSearch');
    const formData = new FormData(searchForm);

    const formDataObject = Object.fromEntries(formData.entries());

    const searchParams = new URLSearchParams(formDataObject);

    fetch(`http://localhost:8000/api/client/search?${searchParams}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
        // body: JSON.stringify(formDataObject)
    })
        .then(response => response.json())
        .then(data => {

            dataClientTablePersist(data);

        })
        .catch(error => {
            console.error('Erro ao enviar dados:', error);
        });

});

function dataClientTablePersist(data)
{
    const tableBody = document.getElementById('tableClients');

    tableBody.innerHTML = '';

    data.forEach(cliente => {


        const row = tableBody.insertRow();
        const id = row.insertCell();
        const name = row.insertCell();
        const cpf = row.insertCell();
        const data = row.insertCell();
        const estado = row.insertCell();
        const cidade = row.insertCell();
        const btn = row.insertCell();

        id.textContent = cliente.id;
        name.textContent = cliente.name;
        cpf.textContent = cliente.cpf;
        data.textContent = formatData(cliente.data);
        estado.textContent = cliente.UF;
        cidade.textContent = cliente.city;
        btn.innerHTML = buttonActionTableClient(cliente.id);

        id.classList.add("px-6", "py-4", "whitespace-no-wrap", "border-b", "text-blue-900", "border-gray-500", "text-sm", "leading-5");
        name.classList.add("px-6", "py-4", "whitespace-no-wrap", "border-b", "text-blue-900", "border-gray-500", "text-sm", "leading-5");
        cpf.classList.add("px-6", "py-4", "whitespace-no-wrap", "border-b", "text-blue-900", "border-gray-500", "text-sm", "leading-5");
        data.classList.add("px-6", "py-4", "whitespace-no-wrap", "border-b", "text-blue-900", "border-gray-500", "text-sm", "leading-5");
        estado.classList.add("px-6", "py-4", "whitespace-no-wrap", "border-b", "text-blue-900", "border-gray-500", "text-sm", "leading-5");
        cidade.classList.add("px-6", "py-4", "whitespace-no-wrap", "border-b", "text-blue-900", "border-gray-500", "text-sm", "leading-5");
        btn.classList.add("px-6", "py-4", "whitespace-no-wrap", "border-b", "text-blue-900", "border-gray-500", "text-sm", "leading-5");
    });
}

function formatData(data) {
    const partes = data.split('-');
    if (partes.length === 3) {
        const ano = partes[0];
        const mes = partes[1];
        const dia = partes[2];

        const dataFormatada = `${dia}/${mes}/${ano}`;
        return dataFormatada;
    } else {
        return data;
    }
}


document.getElementById('formEdit').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    const formDataObject = Object.fromEntries(formData.entries());

    fetch(`http://localhost:8000/api/client/${formDataObject.idClient}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formDataObject)
    })
        .then(response => {
            if (response.status === 422) {

                return response.json().then(data => {
                    console.error('Erro de validação:', data.errors);
                    alert('Erro ao editar preencha todo os campos');
                    return false;
                });

            } else {
                return response.json();
            }
        })
        .then(data => {
            if (data) {
                window.location.href = "http://localhost:8000/";
            }
        })
        .catch(error => {
            console.error('Erro ao enviar dados:', error);
        });
});

document.addEventListener("DOMContentLoaded", function () {
    listClients();
});

async function listClients() {

    const response = await fetch("http://localhost:8000/api/clients");
    const clients = await response.json();

    dataClientTablePersist(clients);
}

function deleteClient(id) {
    if (window.confirm("Deseja realmente excluír este cliente?")) {
        fetch(`http://localhost:8000/api/client/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
        })
            .then(response => response.json())
            .then(data => {
                alert('CLIENTE EXCLUÍDO COM SUCESSO');
                window.location.href = "http://localhost:8000/";
            })
            .catch(error => {
                console.error('Erro ao deletar:', error);
            });

        listClients();
    }
}

function showClientEdit(id) {
    fetch(`http://localhost:8000/api/client/${id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    })
        .then(response => response.json())
        .then(data => {

            const secondRadioSet = document.getElementById('sexEdit');

            const inputGenero = secondRadioSet.querySelector(`input[name="sex"][value="${data.sex}"]`);

            if (inputGenero) {
                inputGenero.checked = true;
            }

            const selectState = document.getElementById('estadoSelectEdit');

            if (selectState) {
                const optionSelecionada = selectState.querySelector(`option[value="${data.state}"]`);

                if (optionSelecionada) {
                    optionSelecionada.selected = true;
                }
            }

            carregarDadosESelecionarCidade(data);

            document.getElementById('cpfEdit').value = data.cpf;
            document.getElementById('nameEdit').value = data.name;
            document.getElementById('dataEdit').value = data.data;
            document.getElementById('addressEdit').value = data.address;
            console.log(data);
        })
        .catch(error => {
            console.error('Erro ao deletar:', error);
        });

    selectEdit = document.getElementById("estadoSelectEdit");
    selectCidadeEdit = document.getElementById("municipioSelectEdit");
    listEstados(selectEdit);

    selectEdit.addEventListener('change', function () {
        const estadoUf = this.value;
        document.getElementById('UFEdit').value = estadoUf;
        listMunicipio(estadoUf, selectCidadeEdit);
    });
    openModalEdit(id);
}

async function carregarDadosESelecionarCidade(data) {
    const selectCity = document.getElementById('municipioSelectEdit');
    await listMunicipio(data.UF, selectCity);

    document.getElementById('UFEdit').value = data.UF;

    if (selectCity) {
        const optionSelecionada = selectCity.querySelector(`option[value="${data.city}"]`);

        console.log(data.city);
        if (optionSelecionada) {
            optionSelecionada.selected = true;
        }
    }
}

function limparFormulario(formId) {
    const formulario = document.getElementById(formId);
    const inputs = formulario.querySelectorAll('input, textarea, select');

    inputs.forEach(input => {
        if (input.type === 'text' || input.type === 'textarea') {
            input.value = '';
        } else if (input.type === 'radio' || input.type === 'checkbox') {
            input.checked = false;
        } else if (input.tagName === 'SELECT') {
            input.selectedIndex = 0;
        }else if (input.type === 'date') {
            input.value = '';
        }
    });
}

function buttonActionTableClient(id) {
    return `
            <button onclick="showClientEdit(${id})" class="px-5 py-2 border-green-500 border text-green-500 rounded transition duration-300 hover:bg-green-700 hover:text-white focus:outline-none">Editar</button>
            <button onclick="deleteClient(${id})" class="px-5 py-2 border-red-500 border text-red-500 rounded transition duration-300 hover:bg-red-700 hover:text-white focus:outline-none">Excluir</button>
        `;
}
