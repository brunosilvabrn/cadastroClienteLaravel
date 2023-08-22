<div id="modalEdit" class="m-10" style="display:none">


    <div
        class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0">

        <div class="bg-white rounded-xl shadow-2xl p-6 sm:w-10/12 mx-10">

            <span class="font-bold block text-2xl mb-6 text-center">Editar</span>

            <form id="formEdit">
                <div class="-mx-3 md:flex mb-6">
                    <input type="hidden" name="idClient" id="idClient">
                    <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                               for="grid-first-name">
                            CPF
                        </label>
                        <input
                            class="mascaraCpf appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                            id="cpfEdit" name='cpf' type="text" placeholder="000.000.000-00">
                    </div>
                    <div class="md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                               for="grid-last-name">
                            Nome
                        </label>
                        <input
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                            id="nameEdit" name="name" type="text" placeholder="">
                    </div>
                    <div class="md:w-2/2 px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                               for="grid-last-name">
                            Data nascimento
                        </label>
                        <input
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                            id="dataEdit" name="data" type="date" placeholder="">
                    </div>
                    <div class="md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                               for="grid-last-name">
                            Sexo
                        </label>
                        <div class="flex" id="sexEdit">
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
                            id="addressEdit" name="address" type="text" placeholder="">
                    </div>
                    <div class="md:w-1/2 px-3">
                        <input type="hidden" id="UFEdit" name="UF">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                               for="grid-state">
                            Estado
                        </label>
                        <div class="relative">
                            <select id="estadoSelectEdit" name="state"
                                    class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded"
                                    id="grid-state">
                                <option value="null">Selecionar estado</option>
                            </select>
                        </div>
                    </div>


                    <div class="md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                               for="grid-state">
                            Cidade
                        </label>
                        <div class="relative">
                            <select id="municipioSelectEdit" name="city"
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
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 mr-3 px-4 rounded">Salvar
                        </button>
                        <span onclick="closeModalEdit()"
                              class="bg-slate-100 hover:bg-slate-200 text-black font-bold py-2 px-4 rounded cursor-pointer">Fechar</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

