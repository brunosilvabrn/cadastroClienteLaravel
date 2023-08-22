@extends('app')

@section('content')
    <main class="container mx-xl m-auto bg-white">
        <div class="shadow-md m-2 p-1">
            <div class="flex p-2 justify-between">
                <img src="{{ asset("img/logo.png") }}" width="100">
                <h3 class="mt-6 ml-2 text-3xl text-left font-bold">Cadastrar cliente</h3>
                <div class="mt-5 ">
                    <a href="{{ route('pesquisar') }}"
                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 mr-3 px-4 rounded mr-auto">Pesquisar
                    </a>
                </div>
            </div>
            <div class="bg-rounded px-8 pt-6 pb-8 mb-4 flex flex-col m-2 border-2">
                <form id="formClient">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="grid-first-name">
                                CPF
                            </label>
                            <input
                                class="mascaraCpf appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                id="grid-first-name" name='cpf' type="text" placeholder="000.000.000-00">
                        </div>
                        <div class="md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="grid-last-name">
                                Nome
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                id="grid-last-name" name="name" type="text" placeholder="">
                        </div>
                        <div class="md:w-2/2 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="grid-last-name">
                                Data nascimento
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                id="grid-last-name" name="data" type="date" placeholder="">
                        </div>
                        <div class="md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="grid-last-name">
                                Sexo
                            </label>
                            <div class="flex">
                                <div class="m-1">
                                    <input type="radio" id="masculino" name="sex" value="Masculino">
                                    <label for="html">Masculino</label><br>
                                </div>
                                <div class="m-1">
                                    <input type="radio" id="feminino" name="sex" value="Feminino">
                                    <label for="css">Feminino</label><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-2">
                        <div class="md:w-2/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="grid-city">
                                Endereço
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                                id="grid-city" name="address" type="text" placeholder="">
                        </div>
                        <div class="md:w-1/2 px-3">
                            <input type="hidden" id="UF" name="UF">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="grid-state">
                                Estado
                            </label>
                            <div class="relative">
                                <select id="estadoSelect" name="state"
                                    class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded"
                                    id="grid-state">
                                    <option value="null">Selecionar estado</option>
                                </select>
                                <!-- <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                      </div> -->
                            </div>
                        </div>


                        <div class="md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="grid-state">
                                Cidade
                            </label>
                            <div class="relative">
                                <select id="municipioSelect" name="city"
                                    class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded"
                                    id="grid-state">
                                    <option value="null">Selecionar municipio</option>
                                </select>

                            </div>
                        </div>

                    </div>
                    <div class="md:col-span-5 text-right">
                        <div class="inline-flex items-end">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 mr-3 px-4 rounded">Salvar</button>
                            <span onclick="limparFormulario('formClient')"
                                class="bg-slate-100 hover:bg-slate-200 text-black font-bold py-2 px-4 rounded cursor-pointer">Limpar</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
