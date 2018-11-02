@extends('layouts.app')

@section('control')
    <form class="form-inline my-2 my-lg-0">
        <input style="width: 470px" class="form-control mr-sm-2" type="text" placeholder="Buscar..." aria-label="Search">
        <button class="btn btn-low my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
    </form>
@endsection

@section('content')
        <div class="col col-md-12">
            <!--You are logged in!

            <ul id="categories">
            @foreach($main as $m)
            <li id="cat_{{$m->id}}"><a href="#{{$m->id}}">{{$m->name}}</a></li>
            @endforeach
            </ul>-->
            <div class="row">
                <div class="col col-md-3" >
                    <h6>Categorias</h6>
                    <tree-view-component></tree-view-component>
                    <!--<div id="tree"></div>
                    <button id="expandAll">Expand All</button>
                    <button id="collapseAll">Collapse All</button>-->
                    <!--<ul style="list-style: none; padding-left: 10px;  width: 100%">
                        <li>Drogarias</li>
                        <li>
                            <ul style="list-style: none;">
                                <li><a href="#">Manipulação(5)</a></li>
                                <li>Homeopatia(2)</li>
                            </ul>
                        </li>
                        <li>Óticas</li>
                        <li>Serviços</li>
                        <li>
                            <ul style="list-style: none;">
                                <li>Guinchos(1)</li>
                                <li>Pet shop(1)</li>
                            </ul>
                        </li>
                    </ul>
                    <br>
                    <h6>Cidades</h6>
                    <ul style="list-style: none;padding-left: 10px; width: 100%">
                        <li><a href="#">Limeira</a></li>
                        <li>Campinas</li>
                        <li>Americana</li>
                    </ul>-->
                </div>
                <div class="col col-md-9">
                    <h6 >Resultados</h6>


                    <div class="row">
                        <div class="col col-md-4">
                            <img style="width: 100%" src="{{ asset('/assets/img/21.jpg') }}" alt="">
                        </div>
                        <div class="col col-md-8">
                            <h5>Cadê Guincho</h5>
                            <p><b>Endereço:</b> Centro, São Paulo - SP, 01014-000
                            <br>
                            <b>Horário:</b> 24hrs
                            <br>
                            <b>Telefone:</b> 4003-3175</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col col-md-4">
                            <img style="width: 100%" src="{{ asset('/assets/img/19.jpg') }}" alt="">
                        </div>
                        <div class="col col-md-8">
                            <h5>Drogal</h5>
                            <p><b>Endereço:</b>  Av. Independência, 2759 - Bairro dos Alemães - Piracicaba/São Paulo, CEP: 13.416-240
                                <br>
                                <b>Horário:</b> 24hrs
                                <br>
                                <b>Telefone:</b> (91) 3244-8092</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col col-md-4">
                            <img style="width: 100%" src="{{ asset('/assets/img/7.jpg') }}" alt="">
                        </div>
                        <div class="col col-md-8">
                            <h5>Só formulas</h5>
                            <p><b>Endereço:</b> R. Francisco Leite, 79 - Centro, Araras - SP, 13600-050
                                <br>
                                <b>Horário:</b> 08:00 às 22:00
                                <br>
                                <b>Telefone:</b> (19) 3541-7141</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')

    <!--- estilo de cores do sitem clube de vantagens
    <style>
        .btn-low{
            background: #F0562B;
            color: white;
        }
        a {
            color: #F0562B;
        }
        body {
            background: url(assets/img/hero.jpg) top fixed;
        }
        /*body {
            background: #18191b;
            color: #ffffff;
        }
        hr {
            color: #ffffff;
        }*/
    </style>
    -->
<script type="text/javascript">

    //function _get(url, callback) {
        //    return $.get(window.BASE_URL + url, callback);
        //}
        //
        //console.log(document.getElementById("categories")
        //    .getElementsByTagName("li"));
        //var items = document.getElementById("categories")
        //    .getElementsByTagName("li");
        //
        //var count = items.length;
        //for (var i = 0; i < count; i++) {
        //    console.log(items[i].id);
        //    console.log(items[i].id.replace('cat_', ''));
        //
        //    if (i > 20)
        //        break;
        //
        //    var id = items[i].id.replace('cat_', '');
        //    var li = document.createElement("li");
        //    li.appendChild(document.createTextNode("Element " + id));
        //    document.getElementById("categories").appendChild(li);
        //
        //    //var li = document.createElement("li");
        //    //li.appendChild(document.createTextNode("Element "+id));
        //    //document.getElementById("categories").appendChild(li);
        //}

</script>

@endsection




