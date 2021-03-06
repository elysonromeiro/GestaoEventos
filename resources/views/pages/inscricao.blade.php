@extends('layout.template')

@section('content')

<section class="form-gradient mb5">
    <div class="container">
        <div class="alinha"></div>
        <br/>
        @guest


        @else
            <form action="/realizarinscricao" method="post" id="formInscricao">
                @csrf
                <div class="card">
                    <div class="card-header">{{ __('Suas informações') }}</div>
                    <br/>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Código</label>
                            <input type="text" class="form-control" value="{{Auth::user()->id}}" disabled>
                            <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="usuario_id">
                        </div>
                        <div class="col-md-6">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Nome</label>
                            <input type="text" class="form-control" value="{{Auth::user()->nome}}" name="usuario_nome" disabled>
                        </div>
                        <div class="col-md-2">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">CPF</label>
                            <input type="text" class="form-control" value="{{Auth::user()->cpf}}" name="usuario_cpf" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">CEP</label>
                            <input type="text" class="form-control" value="{{Auth::user()->Endereco->cep}}" name="endereco_cep" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Rua</label>
                            <input type="text" class="form-control" value="{{Auth::user()->Endereco->rua}}" name="endereco_rua" disabled>
                        </div>
                        <div class="col-md-2">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Bairro</label>
                            <input type="text" class="form-control" value="{{Auth::user()->Endereco->bairro}}" name="endereco_bairro" disabled>
                        </div>
                        <div class="col-md-2">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Cidade</label>
                            <input type="text" class="form-control" value="{{Auth::user()->Endereco->cidade}}" name="endereco_cidade" disabled>
                        </div>
                    </div>
                    <br/>
                </div>
                <br/>
                <div class="card">
                    <div class="card-header">{{ __('Informações do evento') }}</div>
                    <br/>

                    <div class="row">
                        <div class="col-md-1"></div>
                        <input type="hidden" class="form-control" value="{{$eventoSelecionado->id}}" name="evento_id">
                        <div class="col-md-6">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Evento</label>
                            <input type="text" class="form-control" value="{{$eventoSelecionado->descricao}}" name="evento_descricao" disabled>
                        </div>
                        <div class="col-md-2">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Data Inicial</label>
                            <input type="text" class="form-control" value="{{date('d / m / y', strtotime($eventoSelecionado->dataInicio))}}" name="evento_dataInicio" disabled>
                        </div>

                        <div class="col-md-2">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Data Final</label>
                            <input type="text" class="form-control" value="{{date('d / m / y', strtotime($eventoSelecionado->dataInicio))}}" name="evento_dataInicio" disabled>
                        </div>
                    </div>

                    <br/>
                    <ul class="list-group" style="min-height: 200px; max-height: 200px; margin-bottom: 10px; overflow:auto;
                                                        ">
                        <div class="row">
                            <div class="col-md-1"></div>

                            <div class="col-md-10">
                                @foreach($atividades as $key => $atividade)

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                    <input type="checkbox" id="{{$atividade->id}}" value="{{$atividade->id}}" onchange="teste({{$atividade->valor}}, {{$atividade->id}})" aria-label="Checkbox for following text input" name="atividade_id[]"></input>
                                                <script>
                                                    function teste(cod, checkbox){
                                                        var valorTotal = parseInt(document.getElementById('valorTotal').value, 10);
                                                        if(document.getElementById(checkbox).checked == true){

                                                            document.getElementById('valorTotal').value = valorTotal + cod;
                                                            document.getElementById('valorTotal2').value = valorTotal + cod;
                                                        }
                                                        else{
                                                            var valorTotal = parseInt(document.getElementById('valorTotal').value, 10);
                                                            document.getElementById('valorTotal').value = valorTotal - cod;
                                                            document.getElementById('valorTotal2').value = valorTotal - cod;

                                                        }

                                                    }
                                                    function consultarVoucher(vouchers){
                                                        var codVoucher = document.getElementById('codigoIdentificadorVoucher').value;
                                                        var achou = 0;
                                                        var valorTotalInscricao = parseInt(document.getElementById('valorTotal').value, 10);
                                                        var percentual = 0;
                                                        for (var i = 0; i < vouchers.length; i++) {
                                                            if(vouchers[i].codigoIdentificador == codVoucher){
                                                                percentual = vouchers[i].percentual;
                                                                document.getElementById('descricaoVoucher').value = vouchers[i].descricao;
                                                                document.getElementById('descontoVoucher').value = vouchers[i].percentual;
                                                                document.getElementById('voucher_id').value = vouchers[i].id;
                                                                achou = 1;
                                                                break;
                                                            }
                                                        }
                                                        if(achou == 0){
                                                            alert('Voucher inválido');
                                                        }
                                                        else{

                                                            valorTotalInscricao = valorTotalInscricao - ((percentual/100)*valorTotalInscricao);
                                                            document.getElementById('valorTotal2').value = valorTotalInscricao;
                                                        }
                                                    }
                                                    function consultarAtividadesSelecionadas(){

                                                        //event.preventDefault();
                                                        var valorAtividades = parseInt(document.getElementById('valorTotal').value, 10)
                                                        if(valorAtividades == 0){
                                                            alert('Selecione pelo menos uma atividade!');
                                                        }
                                                        else{

                                                            document.getElementById('formInscricao').submit()
                                                        }
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="{{$atividade->descricao}}" disabled>

                                        <div class="input-group-prepend">
                                            <span class="input-group-text">R$</span>
                                            <input class="input-group-text" id="valorAtividade" value="{{$atividade->valor}}" name="vlrAtividade"></input>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                        </div>

                    </ul>


                    <div class="row">
                        <div class="col-md-9"></div>

                        <div class="col-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Valor Total R$</span>
                                <input class="input-group-text col-md-3" type="number" id="valorTotal" value="0" name="valorTotalParcial"></input>
                            </div>
                        </div>



                        <br/>
                        <br/>
                        <br/>
                        <br/>
                    </div>


                </div>
                </br>
                <div class="card">
                    <div class="card-header">{{ __('Desconto') }}</div>
                    </br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="input-group-prepend">
                            <input class="form-control" type="hidden" name="voucher_id" id="voucher_id"></input>
                            <span class="input-group-text col-md-6">Código Voucher</span>
                            <input class="form-control col-md-7" id="codigoIdentificadorVoucher" name="codigoIdentificadorrVoucher"></input>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <button type="button" onclick="consultarVoucher({{$vouchers}})" class="btn btn-primary">
                                {{ __('Consultar') }}
                            </button>
                            <script>

                            </script>
                        </div>
                    </div>
                    </br>
                    <div class="row">

                        <div class="col-md-1"></div>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Descrição do Voucher</span>
                            <input class="form-control" id="descricaoVoucher" name="descricaoVoucher"></input>
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Desconto(%)</span>
                            <input class="form-control" id="descontoVoucher" name="descontoVoucher"></input>
                        </div>
                        <div class="col-md-3"></div>


                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-7"></div>

                        <div class="col-md-5">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary col-md-4" onclick="consultarAtividadesSelecionadas()">
                                    Concluir
                                </button>
                                <script>

                                </script>
                                <span class="input-group-text">Valor Total R$</span>
                                <input class="input-group-text col-md-3" type="number" id="valorTotal2" value="0" name="valor"></input>
                            </div>
                        </div>
                    </div>



                        <br/>
                        <br/>
                    </div>
                    </div>
                    </div>
                </br>
                </div>
            </form>
        @endguest

    </div>

</section>
@endsection
